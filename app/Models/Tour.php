<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Tour extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['average_rating'];

    public function category()
    {
        return $this->belongsTo(TourCategory::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }

    public function reviews()
    {
        return $this->hasMany(TourReview::class);
    }
    public function faqs()
    {
        return $this->hasMany(ToursFaq::class);
    }
    public function details()
    {
        return $this->hasMany(TourDetail::class);
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function attributes()
    {
        return $this->belongsToMany(TourAttribute::class, 'tour_attribute_tour_attribute_item')
            ->withPivot('tour_attribute_item_id')
            ->withTimestamps();
    }

    public function getAverageRatingAttribute()
    {
        $totalReviews = $this->reviews()->count();
        $sumOfRatings = $this->reviews()->sum('rating');

        return $totalReviews > 0 ? round($sumOfRatings / $totalReviews, 1) : null;
    }

    public function medias()
    {
        return $this->hasMany(TourMedia::class, 'tour_id');
    }
    public function availabilities()
    {
        return $this->hasMany(TourAvailability::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            if ($item->isForceDeleting()) {
                self::deleteImage($item->featured_image);
                if ($item->seo) {
                    self::deleteImage($item->seo->seo_featured_image);
                    self::deleteImage($item->seo->fb_featured_image);
                    self::deleteImage($item->seo->tw_featured_image);
                    $item->seo->delete();
                }
                $item->attributes()->detach();
                $item->medias()->each(function ($media) {
                    self::deleteImage($media->image_path);
                });
                $item->reviews()->each(function ($review) {
                    $review->delete();
                });
                $item->faqs()->each(function ($faq) {
                    $faq->delete();
                });
                $item->details()->each(function ($detail) {
                    $detail->delete();
                });
                $item->availabilities()->each(function ($availability) {
                    $availability->openHours()->each(function ($openHour) {
                        $openHour->delete();
                    });
                    $availability->delete();
                });
            }
        });
    }

    public static function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

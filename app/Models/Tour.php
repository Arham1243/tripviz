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

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
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
                $item->cities()->detach();

                $item->medias()->each(function ($media) {
                    self::deleteImage($media->image_path);
                });
                $item->reviews()->each(function ($review) {
                    $review->delete();
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

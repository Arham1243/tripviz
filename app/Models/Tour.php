<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_desc',
        'rating',
        'img_path',
        'for_adult_price',
        'for_child_price',
        'for_car_price',
        'show_on_homepage',
        'price_type',
        'highlights'.
            'is_active',
    ];

    protected $appends = ['average_rating'];

    public function getForAdultPriceAttribute($value)
    {
        return env('APP_CURRENCY').$value;
    }

    public function getForChildPriceAttribute($value)
    {
        return env('APP_CURRENCY').$value;
    }

    public function getForCarPriceAttribute($value)
    {
        return env('APP_CURRENCY').$value;
    }

    public function normalForAdultPrice()
    {
        return $this->attributes['for_adult_price'];
    }

    public function normalForChildPrice()
    {
        return $this->attributes['for_child_price'];
    }

    public function normalForCarPrice()
    {
        return $this->attributes['for_car_price'];
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(TourReview::class)->where('tour_reviews.is_active', true);
    }

    public function getAverageRatingAttribute()
    {
        $totalReviews = $this->reviews()->count();
        $sumOfRatings = $this->reviews()->sum('rating');

        return $totalReviews > 0 ? round($sumOfRatings / $totalReviews, 1) : null;
    }

    public function faqs()
    {
        return $this->hasMany(ToursFaq::class, 'tour_id');
    }

    public function itineraries()
    {
        return $this->hasMany(TourItinerary::class, 'tour_id');
    }

    public function tour_attributes()
    {
        return $this->hasMany(TourAttribute::class, 'tour_id');
    }

    public function inclusions()
    {
        return $this->hasMany(TourInclusion::class, 'tour_id');
    }

    public function exclusions()
    {
        return $this->hasMany(TourExclusion::class, 'tour_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tour) {
            $tour->cities()->detach();
            $tour->categories()->detach();

            $tour->faqs()->each(function ($faq) {
                $faq->delete();
            });
            $tour->itineraries()->each(function ($itinerary) {
                $itinerary->delete();
            });
            $tour->tour_attributes()->each(function ($tour_attribute) {
                $tour_attribute->delete();
            });
            $tour->inclusions()->each(function ($inclusion) {
                $inclusion->delete();
            });
            $tour->exclusions()->each(function ($exclusion) {
                $exclusion->delete();
            });
            $tour->reviews()->each(function ($review) {
                $review->delete();
            });
        });
    }
}

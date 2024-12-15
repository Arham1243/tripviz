<?php

namespace App\Http\Controllers\Frontend\Tour;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourCategory;

class CategoryController extends Controller
{
    public function details($slug)
    {
        $item = TourCategory::where('slug', $slug)->firstOrFail();
        $featuredTours = Tour::whereIn('id', json_decode($item->top_featured_tour_ids ?? '[]'))->where('status', 'publish')->get();
        $bottomFeaturedTours = Tour::whereIn('id', json_decode($item->bottom_featured_tour_ids ?? '[]'))->where('status', 'publish')->get();
        $recomTours = Tour::whereIn('id', json_decode($item->recommended_tour_ids ?? '[]'))->where('status', 'publish')->get();
        $featuredReviews = Testimonial::whereIn('id', json_decode($item->tour_reviews_ids ?? '[]'))->where('status', 'active')
            ->where('rating', '5')
            ->get();
        $totalActivities = $featuredTours->merge($bottomFeaturedTours)->merge($recomTours)->unique('id')->count();
        $data = compact(
            'item',
            'featuredReviews',
            'featuredTours',
            'bottomFeaturedTours',
            'recomTours',
            'totalActivities'
        );

        return view('frontend.tour.category.details')
            ->with('title', ucfirst(strtolower($item->name)))
            ->with($data);
    }
}

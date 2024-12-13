<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $query = Page::where('slug', $slug);

        if (request()->query('viewer') !== 'admin') {
            $query->where('status', 'publish');
        }
        $page = $query->firstOrFail();
        $sections = $page->sections()->withPivot('content')->orderBy('pivot_order')->get();
        $bannerSection = $sections->filter(function ($item) {
            return $item['section_key'] === 'banner';
        })->first();
        $bannerContent = $bannerSection ? json_decode($bannerSection->pivot->content) : null;
        $reviewDetails = null;
        if ($bannerContent && isset($bannerContent->is_review_enabled) && $bannerContent->review_type !== 'custom') {
            $fetchReviewController = new FetchReviewController;
            $request = app('request');
            $reviewContent = $fetchReviewController->fetchReview($request, $type = $bannerContent->review_type);
            if ($reviewContent) {
                $reviewDetails = $reviewContent->getData(true);
            }
        }

        return view('frontend.page-builder.page', compact('page', 'sections', 'reviewDetails'));
    }
}

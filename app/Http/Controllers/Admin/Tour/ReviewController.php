<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\TourReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = TourReview::with('tour', 'user')->get();

        return view('admin.tours.reviews.list', compact('reviews'))->with('title', 'Tour Reviews');
    }

    public function edit($id)
    {
        $review = TourReview::findOrFail($id);

        return view('admin.tours.reviews.edit', compact('review'))->with('title', ucfirst(strtolower($review->tour->title ?? '')));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'review' => 'required|string|max:255',
            'rating' => 'required|int',
        ]);

        $review = TourReview::findOrFail($id);
        $review->update($validatedData);

        return redirect()->route('admin.tour-reviews.index')->with('notify_success', 'Review updated successfully.');
    }
}

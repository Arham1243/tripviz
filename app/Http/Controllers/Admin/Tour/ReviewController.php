<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\TourReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = TourReview::with('tour', 'user')->get();

        return view('admin.tour-reviews.list', compact('reviews'))->with('title', 'Tour Reviews');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $review = TourReview::findOrFail($id);

            return view('admin.tour-reviews.edit', compact('review'))->with('title', 'View Tour Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-reviews.index')->with('notify_error', 'Review not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = TourReview::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.tour-reviews.index')->with('notify_success', 'Category deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-reviews.index')->with('notify_error', 'Category not found.');
        }
    }

    public function suspend($id)
    {
        try {
            $category = TourReview::findOrFail($id);
            $category->is_active = ! $category->is_active;
            $category->save();

            return redirect()->route('admin.tour-reviews.index')->with('notify_success', 'Review status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-reviews.index')->with('notify_error', 'Review not found.');
        }
    }
}

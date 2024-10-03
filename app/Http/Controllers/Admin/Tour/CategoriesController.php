<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourReview;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TourCategory::latest()->get();
        $data = compact('categories');

        return view('admin.tours.categories.main')->with('title', 'Tour Categories')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'tour_categories');
        $data = array_merge($validatedData, ['slug' => $slug]);

        TourCategory::create($data);

        return redirect()->route('admin.tour-categories.index')->with('notify_success', 'Category Added successfully.');
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
        $category = TourCategory::findOrFail($id);
        $tours = Tour::where('status', 'publish')->get();
        $toursReviews = TourReview::where('is_active', 1)->get();
        $seo = $category->seo()->first();
        $data = compact('category', 'seo', 'tours', 'toursReviews');

        return view('admin.tours.categories.edit')->with('title', ucfirst(strtolower($category->name)))->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:publish,draft',
            'slug' => 'nullable|string|max:255',
            'bottom_featured_tour_ids' => 'nullable|array',
            'top_featured_tour_ids' => 'nullable|array',
            'recommended_tour_ids' => 'nullable|array',
            'tour_reviews_ids' => 'nullable|array',
            'tour_count_heading' => 'nullable|string|max:255',
            'tour_count_btn_link' => 'nullable|string|max:255',
            'tour_count_image' => 'nullable|image|max:2048',
            'featured_image_alt_text' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $category = TourCategory::findOrFail($id);

        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'tour_categories', $category->slug);

        $data = array_merge($validatedData, ['slug' => $slug]);

        // Handle JSON IDs
        $data['bottom_featured_tour_ids'] = json_encode($request->input('bottom_featured_tour_ids', []));
        $data['recommended_tour_ids'] = json_encode($request->input('recommended_tour_ids', []));
        $data['tour_reviews_ids'] = json_encode($request->input('tour_reviews_ids', []));

        $category->update($data);
        handleSeoData($request, $category, 'Tours/Categories');
        $this->uploadImg('featured_image', 'Tours/Categories/Featured-image', $category, 'featured_image');
        $this->uploadImg('tour_count_image', 'Tours/Categories/Count-Section/Bg', $category, 'tour_count_image');

        return redirect()->route('admin.tour-categories.index')->with('notify_success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

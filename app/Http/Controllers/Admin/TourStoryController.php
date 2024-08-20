<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourStory;
use App\Models\City;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\UploadImageTrait;
use App\Traits\Sluggable;

class TourStoryController extends Controller
{
    use UploadImageTrait;
    use Sluggable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = TourStory::with("city")->get();
        return view('admin.tour-stories-management.list', compact('stories'))->with('title', 'Tour Stories and News');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where("is_active", 1)->get();
        $data = compact('cities');
        return view('admin.tour-stories-management.add', $data)->with('title', 'Add New Story');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'title' => 'required|string|max:255',
            'estimated_read_time' => 'required|integer|min:1',
            'short_desc' => 'required|string',
            'long_desc' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'show_on_homepage' => 'nullable|boolean',
        ]);

        $slug = $this->createSlug($validatedData['title'], 'tour_stories'); // Generate slug from title

        $data = $validatedData;
        $data['slug'] = $slug;

        $tourStory = TourStory::create($data);

        $this->uploadImg('img_path', 'img_path', 'Story/Thumbnail', $tourStory);

        return redirect()->route('admin.tour-stories.index')->with('notify_success', 'Story created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourStory  $tourStory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tourStory = TourStory::findOrFail($id);
            return view('admin.tour-stories-management.show', compact('tourStory'))->with('title', 'Story Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-stories.index')->with('notify_error', 'Story not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourStory  $tourStory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $tourStory = TourStory::findOrFail($id);
            $cities = City::where("is_active", 1)->get();
            return view('admin.tour-stories-management.edit', compact('tourStory', 'cities'))->with('title', 'Edit Story');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-stories.index')->with('notify_error', 'Story not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TourStory  $tourStory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $tourStory = TourStory::findOrFail($id);

            $request->validate([
                'city_id' => 'required|exists:cities,id',
                'title' => 'required|string|max:255',
                'estimated_read_time' => 'required|integer|min:1',
                'short_desc' => 'required|string',
                'long_desc' => 'nullable|string',
                'img_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
                'show_on_homepage' => 'nullable|boolean',
            ]);

            // Prepare the data for update
            $data = $request->except('img_path');

            // Ensure show_on_homepage is set to 0 if unchecked
            $data['show_on_homepage'] = $request->has('show_on_homepage') ? true : false;

            // Generate the slug from the title
            $data['slug'] = $this->createSlug($data['title'], 'tour_stories');

            // Handle the image upload
            if ($request->hasFile('img_path')) {
                $this->uploadImg('img_path', 'img_path', 'Story/Thumbnail', $tourStory);
            }

            // Update the story with the data
            $tourStory->update($data);

            return redirect()->route('admin.tour-stories.index')->with('notify_success', 'Story updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-stories.index')->with('notify_error', 'Story not found.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourStory  $tourStory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tourStory = TourStory::findOrFail($id);
            $tourStory->delete();

            return redirect()->route('admin.tour-stories.index')->with('notify_success', 'Story deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-stories.index')->with('notify_error', 'Story not found.');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  \App\Models\TourStory  $tourStory
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $tourStory = TourStory::findOrFail($id);
            $tourStory->is_active = !$tourStory->is_active;
            $tourStory->save();

            return redirect()->route('admin.tour-stories.index')->with('notify_success', 'Story status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tour-stories.index')->with('notify_error', 'Story not found.');
        }
    }
}

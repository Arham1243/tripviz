<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogs-management.list')->with('title', 'All Blogs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('is_active', 1)->get();

        return view('admin.cities-management.add', compact('countries'))->with('title', 'Add New City');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'country_id' => 'required|int',
            'name' => 'required|string|max:255',
            'img_path' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'show_on_homepage' => 'nullable',
            'short_desc' => 'required',
        ]);

        // Generate a unique slug based on the name
        $slug = $this->createSlug($validatedData['name'], 'cities');

        // Add the slug to the validated data
        $data = array_merge($validatedData, ['slug' => $slug]);

        // Create the city record
        $city = City::create($data);

        // Handle the image upload
        $this->uploadImg('img_path', 'img_path', 'City/Thumbnail', $city);

        return redirect()->route('admin.cities.index')->with('notify_success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('admin.cities-management.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::where('is_active', 1)->get();

        return view('admin.cities-management.edit', compact('city', 'countries'))->with('title', 'Edit City');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'country_id' => 'required|int',
            'name' => 'required|string|max:255',
            'img_path' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'show_on_homepage' => 'nullable', // Ensure this is a boolean
            'short_desc' => 'required',
        ]);

        // Generate a unique slug based on the name
        $slug = $this->createSlug($request->input('name'), 'cities');

        // Add the slug to the validated data
        $data = array_merge($validatedData, ['slug' => $slug]);

        // Set show_on_homepage to 0 if not present in the request
        $data['show_on_homepage'] = $request->has('show_on_homepage') ? $validatedData['show_on_homepage'] : 0;

        // Update the city record
        $city->update($data);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('img_path')) {
            $this->uploadImg('img_path', 'img_path', 'City/Thumbnail', $city);
        }

        return redirect()->route('admin.cities.index')->with('notify_success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->route('admin.cities.index')->with('notify_success', 'City deleted successfully.');
    }

    public function suspend(City $city)
    {
        $city->is_active = ! $city->is_active;
        $city->save();

        return redirect()->route('admin.cities.index')->with('notify_success', 'City status updated successfully.');
    }
}

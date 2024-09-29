<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Location::latest()->get();
        $parentItems = Location::all();
        $data = compact('items', 'parentItems');

        return view('admin.locations-management.main')->with('title', 'Location')->with($data);
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
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_location_id' => 'nullable|exists:locations,id',
        ]);
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'locations');
        $data = array_merge($validatedData, ['slug' => $slug]);
        Location::create($data);

        return redirect()->route('admin.locations.index')->with('notify_success', 'Locations Added successfully.');
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
        $item = Location::where('id', $id)->firstOrFail();
        $parentItems = Location::whereNotIn('id', [$id])->get();
        $seo = $item->seo()->first();
        $data = compact('item', 'parentItems', 'seo');

        return view('admin.locations-management.edit')->with('title', ucfirst(strtolower($item->name)))->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_location_id' => 'nullable|exists:locations,id',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'feature_image' => 'nullable|image',
            'feature_image_alt_text' => 'nullable|string|max:255',
        ]);

        $item = Location::where('id', $id)->firstOrFail();
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $newSlug = $this->createSlug($slugText, 'locations', $item->slug);
        $data = array_merge($validatedData, ['slug' => $newSlug]);

        $item->update($data);

        $this->uploadImg('feature_image', 'Location/Featured-image', $item, 'feature_image');

        $this->handleSeoData($request, $item, 'Location');

        return redirect()->route('admin.locations.index')->with('notify_success', 'Location updated successfully.');
    }

    public function handleSeoData($request, $entry, $resource)
    {
        $seoData = $request->only([
            'is_seo_index',
            'seo_title',
            'seo_description',
            'fb_title',
            'fb_description',
            'tw_title',
            'tw_description',
            'schema',
            'canonical',
        ]);

        $seo = $entry->seo()->updateOrCreate([], $seoData);

        $imageFields = [
            'seo_featured_image',
            'fb_featured_image',
            'tw_featured_image',
        ];

        foreach ($imageFields as $field) {
            $this->uploadImg($field, "Seo/$resource/$field", $seo, $field);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    public function index()
    {
        $items = Country::latest()->get();

        return view('admin.locations.countries-management.list', compact('items'))->with('title', 'Countries');
    }

    public function create()
    {
        return view('admin.locations.countries-management.add')->with('title', 'Add New Country');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable',
            'status' => 'nullable|in:publish,draft',
            'featured_image' => 'nullable|image',
            'featured_image_alt_text' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image',
            'banner_image_alt_text' => 'nullable|string|max:255',
        ]);
        $slug = $this->createSlug($validatedData['name'], 'countries');

        $featuredImage = null;
        $bannerImage = null;

        if ($request->hasFile('featured_image')) {
            $featuredImage = $this->simpleUploadImg($request->file('featured_image'), 'Location/Country/Featured-images');
        }

        if ($request->hasFile('banner_image')) {
            $bannerImage = $this->simpleUploadImg($request->file('banner_image'), 'Location/Country/Banner-images');
        }

        $data = array_merge($validatedData, [
            'slug' => $slug,
            'featured_image' => $featuredImage,
            'banner_image' => $bannerImage,
        ]);

        $item = Country::create($data);

        handleSeoData($request, $item, 'Country');

        return redirect()->route('admin.countries.index')->with('notify_success', 'Country Added successfully!');
    }

    public function edit($id)
    {
        $item = Country::find($id);
        $seo = $item->seo()->first();

        return view('admin.locations.countries-management.edit', compact('item', 'seo'))->with('title', ucfirst(strtolower($item->name)));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'nullable|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable',
            'status' => 'nullable|in:publish,draft',
            'featured_image' => 'nullable|image',
            'featured_image_alt_text' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image',
            'banner_image_alt_text' => 'nullable|string|max:255',
        ]);

        $item = Country::find($id);
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'countries', $item->slug);
        $featuredImage = $item->featured_image;
        $bannerImage = $item->banner_image;

        if ($request->hasFile('featured_image')) {
            $featuredImage = $this->simpleUploadImg($request->file('featured_image'), 'Location/Country/Featured-images', $item->featured_image);
        }

        if ($request->hasFile('banner_image')) {
            $bannerImage = $this->simpleUploadImg($request->file('banner_image'), 'Location/Country/Banner-images', $item->banner_image);
        }

        $data = array_merge($validatedData, [
            'slug' => $slug,
            'featured_image' => $featuredImage,
            'banner_image' => $bannerImage,
        ]);

        $item->update($data);

        handleSeoData($request, $item, 'Country');

        return redirect()->route('admin.countries.index')
            ->with('notify_success', 'Country updated successfully.');
    }
}

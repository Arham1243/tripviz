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
        $items = Country::get();

        return view('admin.countries-management.list', compact('items'))->with('title', 'Countries');
    }

    public function create()
    {
        return view('admin.countries-management.add')->with('title', 'Add New Country');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'featured_image' => 'required|image',
            'featured_image_alt_text' => 'nullable|string|max:255',
        ]);
        $slug = $this->createSlug($validatedData['name'], 'countries');
        $data = array_merge($validatedData, ['slug' => $slug]);
        $item = Country::create($data);

        $this->uploadImg('featured_image', 'Country/Featured-image', $item, 'featured_image');

        $this->handleSeoData($request, $item, 'Country');

        return redirect()->route('admin.countries.index')->with('notify_success', 'Country Added successfully!');
    }

    public function edit($id)
    {
        $item = Country::find($id);
        $seo = $item->seo()->first();

        return view('admin.countries-management.edit', compact('item', 'seo'))->with('title', ucfirst(strtolower($item->name)));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'featured_image' => 'nullable|image',
            'featured_image_alt_text' => 'nullable|string|max:255',
        ]);
        $item = Country::find($id);
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'countries', $item->slug);

        $data = array_merge($validatedData, [
            'slug' => $slug,
        ]);

        $item->update($data);
        $this->uploadImg('featured_image', 'Country/Featured-image', $item, 'featured_image');
        $this->handleSeoData($request, $item, 'Country');

        return redirect()->route('admin.countries.index')
            ->with('notify_success', 'Country updated successfully.');
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
}

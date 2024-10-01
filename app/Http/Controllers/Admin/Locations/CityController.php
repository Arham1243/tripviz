<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    public function index()
    {
        $items = City::get();

        return view('admin.cities-management.list', compact('items'))->with('title', 'Cities');
    }

    public function create()
    {
        $countries = Country::where('status', 'publish')->get();

        return view('admin.cities-management.add', compact('countries'))->with('title', 'Add New City');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'country_id' => 'nullable|int',
            'featured_image' => 'required|image',
            'featured_image_alt_text' => 'nullable|string|max:255',
        ]);
        $slug = $this->createSlug($validatedData['name'], 'cities');
        $data = array_merge($validatedData, ['slug' => $slug]);
        $item = City::create($data);

        $this->uploadImg('featured_image', 'City/Featured-image', $item, 'featured_image');

        handleSeoData($request, $item, 'City');

        return redirect()->route('admin.cities.index')->with('notify_success', 'City Added successfully!');
    }

    public function edit($id)
    {
        $item = City::find($id);
        $countries = Country::where('status', 'publish')->get();
        $seo = $item->seo()->first();

        return view('admin.cities-management.edit', compact('item', 'seo', 'countries'))->with('title', ucfirst(strtolower($item->name)));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'country_id' => 'nullable|int',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'featured_image' => 'nullable|image',
            'featured_image_alt_text' => 'nullable|string|max:255',
        ]);
        $item = City::find($id);
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'cities', $item->slug);

        $data = array_merge($validatedData, [
            'slug' => $slug,
        ]);

        $item->update($data);
        $this->uploadImg('featured_image', 'City/Featured-image', $item, 'featured_image');
        handleSeoData($request, $item, 'City');

        return redirect()->route('admin.cities.index')
            ->with('notify_success', 'City updated successfully.');
    }
}

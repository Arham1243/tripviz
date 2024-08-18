<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Category;
use App\Models\City;
use App\Models\ToursFaq;
use App\Models\TourItinerary;
use App\Models\TourAttribute;
use App\Models\TourInclusion;
use App\Models\TourExclusion;
use App\Models\AdditionalItem;
use App\Models\ToursAdditional;
use Illuminate\Http\Request;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\Sluggable;

class TourController extends Controller
{
    use UploadImageTrait;
    use Sluggable;
    public function index()
    {
        $tours = Tour::with(['category', 'city'])->latest()->get();
        return view('admin.tours-management.list', compact('tours'))->with('title', 'Tours');
    }

    public function create()
    {
        $categories = Category::where("is_active", 1)->get();

        $cities = City::where("is_active", 1)->get();
        return view('admin.tours-management.add', compact('categories', 'cities'))->with('title', 'Add New Tour');
    }

    public function store(Request $request)
    {


        $priceType = $request->input('price_type');

        // Define validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'img_path' => 'required',
            'short_desc' => 'required|string',
            'price_type' => 'required|in:per_person,per_car',
            'city_ids' => 'required|array',
            'category_ids' => 'required|array',
            'show_on_homepage' => 'nullable',
        ];

        if ($priceType === 'per_person') {
            $rules['for_adult_price'] = 'required|numeric|min:0';
            $rules['for_child_price'] = 'required|numeric|min:0';
        } else {
            $rules['for_car_price'] = 'required|numeric|min:0';
        }

        $validatedData = $request->validate($rules);

        // Generate unique slug
        $slug = $this->createSlug($validatedData['title'], 'tours');

        // Add the slug to the validated data
        $data = array_merge($validatedData, ['price_type' => $priceType, 'slug' => $slug]);

        // Create the Tour record
        $tour = Tour::create($data);

        // Sync relationships
        $tour->cities()->attach($validatedData['city_ids']);
        $tour->categories()->attach($validatedData['category_ids']);

        // Handle image upload
        $this->uploadImg('img_path', 'img_path', 'Tour/Cover-images', $tour);

        return redirect()->route('admin.tours.edit', $tour->id)->with('notify_success', 'Tour Added successfully.')->with('active_tab', 'details');
    }




    public function show($id)
    {
        try {
            $tour = Tour::findOrFail($id);
            return view('admin.tours-management.show', compact('tour'))->with('title', 'Tour Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours.index')->with('notify_error', 'Tour not found.');
        }
    }

    public function edit($id)
    {
        try {
            $tour = Tour::findOrFail($id);
            $categories = Category::where("is_active", 1)->get();
            $cities = City::where("is_active", 1)->get();
            $faqs = ToursFaq::where("tour_id", $tour->id)->with('tour')->get();
            $itineraries = TourItinerary::where("tour_id", $tour->id)->orderBy('day', 'asc')->get();
            $attributes = TourAttribute::where("tour_id", $tour->id)->get();
            $inclusions = TourInclusion::where("tour_id", $tour->id)->get();
            $exclusions = TourExclusion::where("tour_id", $tour->id)->get();
            $additionals = ToursAdditional::where("is_active", 1)->get();
            $additionalItems = AdditionalItem::where("tour_id", $tour->id)->get();
            $data = compact('tour', 'categories', 'cities', 'faqs', 'itineraries', 'attributes', 'inclusions', 'exclusions', 'additionals', 'additionalItems');
            return view('admin.tours-management.edit', $data)->with('title', 'Edit Tour');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours.index')->with('notify_error', 'Tour not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $priceType = $request->input('price_type');

        // Define validation rules
        $rules = [
            'title' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
            'price_type' => 'required|in:per_person,per_car',
            'city_ids' => 'required|array',
            'category_ids' => 'required|array',
            'show_on_homepage' => 'nullable',
        ];
        if ($priceType === 'per_person') {
            $rules['for_adult_price'] = 'required|numeric|min:0';
            $rules['for_child_price'] = 'required|numeric|min:0';
            $rules['for_car_price'] = 'nullable'; // Ensure 'for_car_price' is not validated if not needed
        } else {
            $rules['for_car_price'] = 'required|numeric|min:0';
            $rules['for_adult_price'] = 'nullable'; // Ensure 'for_adult_price' is not validated if not needed
            $rules['for_child_price'] = 'nullable'; // Ensure 'for_child_price' is not validated if not needed
        }

        if (!$request->show_on_homepage) {
            $show_on_homepage = 0;
        }

        $validatedData = $request->validate($rules);

        // Set price_type and other fields
        $data = array_merge($validatedData, ['price_type' => $priceType, 'show_on_homepage' => isset($show_on_homepage) ? $show_on_homepage :$request->show_on_homepage ]);

        // Handle price fields based on price_type
        if ($priceType === 'per_person') {
            $data['for_car_price'] = null; // Clear irrelevant field
        } else {
            $data['for_adult_price'] = null; // Clear irrelevant fields
            $data['for_child_price'] = null;
        }

        // Generate new slug if the title has changed
        if (!empty($validatedData['title']) && $validatedData['title'] !== $tour->title) {
            $data['slug'] = $this->createSlug($validatedData['title'], 'tours');
        }

        $tour->update($data);

        // Sync relationships
        $tour->cities()->sync($validatedData['city_ids']);
        $tour->categories()->sync($validatedData['category_ids']);

        // Handle image upload
        $this->uploadImg('img_path', 'img_path', 'Tour/Cover-images', $tour);

        return redirect()->route('admin.tours.index')->with('notify_success', 'Tour updated successfully.');
    }



    public function destroy($id)
    {
        try {
            $tour = Tour::findOrFail($id);
            $tour->delete();

            return redirect()->route('admin.tours.index')->with('notify_success', 'Tour deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours.index')->with('notify_error', 'Tour not found.');
        }
    }

    public function suspend($id)
    {
        try {
            $tour = Tour::findOrFail($id);
            $tour->is_active = !$tour->is_active;
            $tour->save();

            return redirect()->route('admin.tours.index')->with('notify_success', 'Tour status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours.index')->with('notify_error', 'Tour not found.');
        }
    }



    public function save_highlights(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'highlights' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'highlights');
        }
        Tour::where("id", $request->tour_id)->update(['highlights' => $request->highlights]);

        return redirect()->back()->with('notify_success', 'Highlights added successfully.')->with('active_tab', 'highlights');
    }
}

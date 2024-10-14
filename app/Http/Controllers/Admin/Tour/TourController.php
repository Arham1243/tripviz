<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\AdditionalItem;
use App\Models\Category;
use App\Models\City;
use App\Models\Tour;
use App\Models\TourAttribute;
use App\Models\TourCategory;
use App\Models\TourExclusion;
use App\Models\TourInclusion;
use App\Models\TourItinerary;
use App\Models\TourMedia;
use App\Models\ToursAdditional;
use App\Models\ToursFaq;
use App\Models\User;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    public function index()
    {
        $tours = Tour::with(['category'])->latest()->get();

        return view('admin.tours.tours-management.list', compact('tours'))->with('title', 'All Tours');
    }

    public function create()
    {
        $categories = TourCategory::where('status', 'publish')->latest()->get();
        // $tours = Tour::where('status', 'publish')->get();
        $tours = Tour::all();
        $users = User::where('is_active', 1)->get();
        $attributes = TourAttribute::where('status', 'active')
            ->whereRaw('JSON_LENGTH(items) > 0')
            ->latest()->get();

        $cities = City::where('status', 'publish')->get();
        $data = compact('categories', 'cities', 'attributes', 'tours', 'users');

        return view('admin.tours.tours-management.add', $data)->with('title', 'Add New Tour');
    }

    public function store(Request $request)
    {
        $general = $request->input('tour.general', []);
        $statusTab = $request->input('tour.status', []);
    
        $slugText = !empty($general['slug']) ? $general['slug'] : $general['title'];
        $slug = $this->createSlug($slugText, 'tours');
    
        $inclusions = !empty($general['inclusions']) ? json_encode($general['inclusions']) : null;
        $exclusions = !empty($general['exclusions']) ? json_encode($general['exclusions']) : null;
        $features = !empty($general['features']) ? json_encode($general['features']) : null;
        $details = !empty($general['details']) ? json_encode($general['details']) : null;
    
        $processedAttributes = [];
    
        $attributes = $statusTab['attributes'] ?? [];
        foreach ($attributes as $attributeId => $items) {
            $processedAttributes[$attributeId] = json_encode($items);
        }
    
        $relatedTours = !empty($request->input('related_tour_ids')) ? json_encode($request->input('related_tour_ids')) : null;
    
        $tour = Tour::create([
            'title' => $general['title'],
            'slug' => $slug,
            'content' => $general['content'],
            'category_id' => $general['category_id'] ?? null,
            'badge_icon_class' => $general['badge_icon_class'],
            'badge_name' => $general['badge_name'],
            'banner_image_alt_text' => $request->input('banner_image_alt_text'),
            'feature_image_alt_text' => $request->input('feature_image_alt_text'),
            'banner_type' => $general['banner_type'],
            'video_link' => $general['video_link'],
            'inclusions' => $inclusions,
            'exclusions' => $exclusions,
            'features' => $features,
            'details' => $details,
            'status' => $statusTab['status'],
            'author_id' => $statusTab['author_id'],
            'is_featured' => $statusTab['is_featured'] ?? 0,
            'featured_state' => $statusTab['featured_state'] ?? null,
            'ical_import_url' => $statusTab['ical_import_url'] ?? null,
            'ical_export_url' => $statusTab['ical_export_url'] ?? null,
            'related_tour_ids' => $relatedTours,
            'attributes' => !empty($processedAttributes) ? json_encode($processedAttributes) : null, // Safely handle attributes
        ]);
    
        // Handle FAQs
        if (isset($general['faq']['question']) && is_array($general['faq']['question'])) {
            foreach ($general['faq']['question'] as $index => $question) {
                $answer = $general['faq']['answer'][$index] ?? null;
                
                if (!empty($question) && !empty($answer)) {
                    ToursFaq::create([
                        'question' => $question,
                        'answer' => $answer,
                        'tour_id' => $tour->id,
                    ]);
                }
            }
        }
    
        // Handle gallery images
        if (!empty($request['gallery'])) {
            $this->uploadMultipleImages(
                'gallery', // Input name for the images
                'Tour/Banner/Gallery', // Folder to store images
                new TourMedia, // Pass the model class name here
                'image_path', // Column name for image path
                'alt_text', // Column name for alt text
                $request['gallery_alt_texts'] ?? null, // Pass alt texts if provided
                'tour_id', // Pass the foreign key column name
                $tour->id // foreign key value
            );
        }
    
        // Handle banner and featured images
        $this->uploadImg('banner_image', 'Tour/Banner/Featured-image', $tour, 'banner_image');
        $this->uploadImg('featured_image', 'Tour/Featured-image', $tour, 'featured_image');
    
        // Handle SEO data
        handleSeoData($request, $tour, 'Tour');
    
        return redirect()->route('admin.tours.index')->with('notify_success', 'Tour Added successfully.')->with('active_tab', 'details');
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
        $tour = Tour::findOrFail($id);
        $categories = TourCategory::where('status', 'publish')->latest()->get();
        // $tours = Tour::where('status', 'publish')->get();
        $tours = Tour::all();
        $users = User::where('is_active', 1)->get();
        $attributes = TourAttribute::where('status', 'active')
            ->whereRaw('JSON_LENGTH(items) > 0')
            ->latest()->get();

        $cities = City::where('status', 'publish')->get();
        $data = compact('tour', 'categories', 'cities', 'attributes', 'tours', 'users');
        return view('admin.tours.tours-management.edit', $data)->with('title', ucfirst(strtolower($tour->title)));
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

        if (! $request->show_on_homepage) {
            $show_on_homepage = 0;
        }

        $validatedData = $request->validate($rules);

        // Set price_type and other fields
        $data = array_merge($validatedData, ['price_type' => $priceType, 'show_on_homepage' => isset($show_on_homepage) ? $show_on_homepage : $request->show_on_homepage]);

        // Handle price fields based on price_type
        if ($priceType === 'per_person') {
            $data['for_car_price'] = null; // Clear irrelevant field
        } else {
            $data['for_adult_price'] = null; // Clear irrelevant fields
            $data['for_child_price'] = null;
        }

        // Generate new slug if the title has changed
        if (! empty($validatedData['title']) && $validatedData['title'] !== $tour->title) {
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
            $tour->is_active = ! $tour->is_active;
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
        Tour::where('id', $request->tour_id)->update(['highlights' => $request->highlights]);

        return redirect()->back()->with('notify_success', 'Highlights added successfully.')->with('active_tab', 'highlights');
    }
}

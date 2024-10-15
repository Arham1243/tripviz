<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\AdditionalItem;
use App\Models\Category;
use App\Models\City;
use App\Models\Tour;
use App\Models\TourAttribute;
use App\Models\TourAvailability;
use App\Models\TourCategory;
use App\Models\TourDetail;
use App\Models\TourExclusion;
use App\Models\TourInclusion;
use App\Models\TourItinerary;
use App\Models\TourMedia;
use App\Models\TourOpenHour;
use App\Models\ToursAdditional;
use App\Models\ToursFaq;
use App\Models\User;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Carbon\Carbon;
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
            ->latest()->get();

        $cities = City::where('status', 'publish')->get();
        $data = compact('categories', 'cities', 'attributes', 'tours', 'users');

        return view('admin.tours.tours-management.add', $data)->with('title', 'Add New Tour');
    }

    public function store(Request $request)
    {
        $general = $request->input('tour.general', []);
        $statusTab = $request->input('tour.status', []);
        $availabilityData = $request->input('tour.availability', []);


        $slugText = !empty($general['slug']) ? $general['slug'] : $general['title'];
        $slug = $this->createSlug($slugText, 'tours');

        $inclusions = !empty($general['inclusions']) ? json_encode($general['inclusions']) : null;
        $exclusions = !empty($general['exclusions']) ? json_encode($general['exclusions']) : null;
        $features = !empty($general['features']) ? json_encode($general['features']) : null;
        $details = !empty($general['details']) ? json_encode($general['details']) : null;

        $relatedTours = !empty($request->input('related_tour_ids')) ? json_encode($request->input('related_tour_ids')) : null;

        $tour = Tour::create([
            'title' => $general['title'],
            'slug' => $slug,
            'content' => $general['content'],
            'category_id' => $general['category_id'] ?? null,
            'badge_icon_class' => $general['badge_icon_class'],
            'badge_name' => $general['badge_name'],
            'banner_image_alt_text' => $request->input('banner_image_alt_text'),
            'featured_image_alt_text' => $request->input('featured_image_alt_text'),
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

        // Handle attributes and items
        if (!empty($statusTab['attributes'])) {
            foreach ($statusTab['attributes'] as $attributeId => $itemIds) {
                foreach ($itemIds as $itemId) {
                    $tour->attributes()->attach($attributeId, ['tour_attribute_item_id' => $itemId]);
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

        // Handle details
        if (!empty($general['details'])) {
            foreach ($general['details'] as $detail) {
                TourDetail::create([
                    'tour_id' => $tour->id,
                    'name' => $detail['name'],
                    'items' => json_encode($detail['items']),
                ]);
            }
        }

        // Store Availability
        if (isset($availabilityData['is_fixed_date']) && $availabilityData['is_fixed_date'] == 1) {
            $availability = TourAvailability::create([
                'tour_id' => $tour->id,
                'is_fixed_date' => $availabilityData['is_fixed_date'] ?? 0,
                'start_date' => Carbon::createFromFormat('Y/m/d', $availabilityData['start_date'])->format('Y-m-d'),
                'end_date' => Carbon::createFromFormat('Y/m/d', $availabilityData['end_date'])->format('Y-m-d'),
                'last_booking_date' => Carbon::createFromFormat('Y/m/d', $availabilityData['last_booking_date'])->format('Y-m-d'),
                'is_open_hours' => $availabilityData['is_open_hours'] ?? 0,
            ]);

            // Store Open Hours if is_open_hours is true
            if (isset($availabilityData['is_open_hours']) && $availabilityData['is_open_hours'] == 1) {
                foreach ($availabilityData['open_hours'] as $hours) {
                    TourOpenHour::create([
                        'tour_availability_id' => $availability->id,
                        'day' => $hours['day'],
                        'open_time' => $hours['open_time'],
                        'close_time' => $hours['close_time'],
                        'enabled' => $hours['enabled'] ?? 0,
                    ]);
                }
            }
        }


        // Handle banner and featured images
        $this->uploadImg('banner_image', 'Tour/Banner/Featured-image', $tour, 'banner_image');
        $this->uploadImg('featured_image', 'Tour/Featured-image', $tour, 'featured_image');

        // Handle SEO data
        handleSeoData($request, $tour, 'Tour');

        return redirect()->route('admin.tours.index')->with('notify_success', 'Tour Added successfully.')->with('active_tab', 'details');
    }


    public function deleteMedia(TourMedia $media)
    {
        if (!$media) {
            return redirect()->back()->with('notify_error', 'Media not found');
        }
        $this->deletePreviousImage($media->image_path ?? null);
        $media->delete();

        return redirect()->back()->with('notify_success', 'Media deleted successfully');
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
        $tour = Tour::with(['attributes', 'attributes.attributeItems','availabilities.openHours'])->find($id);
        $attributes = TourAttribute::where('status', 'active')
            ->latest()->get();
        $categories = TourCategory::where('status', 'publish')->latest()->get();
        // $tours = Tour::where('status', 'publish')->get();
        $tours = Tour::all();
        $users = User::where('is_active', 1)->get();

        $cities = City::where('status', 'publish')->get();
        $data = compact('tour', 'categories', 'cities', 'tours', 'users', 'attributes');
        return view('admin.tours.tours-management.edit', $data)->with('title', ucfirst(strtolower($tour->title)));
    }

    public function update(Request $request, $id)
    {
        dd($request->all());

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

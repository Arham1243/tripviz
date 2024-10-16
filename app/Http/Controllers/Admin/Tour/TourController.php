<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Tour;
use App\Models\TourAttribute;
use App\Models\TourCategory;
use App\Models\TourDetail;
use App\Models\TourExtraPrice;
use App\Models\TourMedia;
use App\Models\TourOpenHour;
use App\Models\TourFaq;
use App\Models\TourPriceDiscount;
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
        $pricing = $request->input('tour.pricing', []);


        $slugText = !empty($general['slug']) ? $general['slug'] : $general['title'];
        $slug = $this->createSlug($slugText, 'tours');

        $inclusions = !empty($general['inclusions']) && !in_array(null, $general['inclusions'], true)
            ? json_encode(array_filter($general['inclusions'], fn($value) => $value !== null))
            : null;

        $exclusions = !empty($general['exclusions']) && !in_array(null, $general['exclusions'], true)
            ? json_encode(array_filter($general['exclusions'], fn($value) => $value !== null))
            : null;

        $features = !empty($general['features']) && !in_array(null, $general['features'], true)
            ? json_encode(array_filter($general['features'], fn($value) => $value !== null))
            : null;

        $relatedTours = !empty($request->input('related_tour_ids')) ? json_encode($request->input('related_tour_ids')) : null;

        $tour = Tour::create([
            'title' => $general['title']  ?? null,
            'slug' => $slug  ?? null,
            'content' => $general['content']  ?? null,
            'category_id' => $general['category_id'] ?? null,
            'badge_icon_class' => $general['badge_icon_class']  ?? null,
            'badge_name' => $general['badge_name']  ?? null,
            'banner_image_alt_text' => $request->input('banner_image_alt_text'),
            'featured_image_alt_text' => $request->input('featured_image_alt_text'),
            'banner_type' => $general['banner_type']  ?? null,
            'video_link' => $general['video_link']  ?? null,
            'inclusions' => $inclusions,
            'exclusions' => $exclusions,
            'features' => $features,
            'status' => $statusTab['status'],
            'author_id' => $statusTab['author_id'],
            'is_featured' => $statusTab['is_featured'] ?? 0,
            'featured_state' => $statusTab['featured_state'] ?? null,
            'ical_import_url' => $statusTab['ical_import_url'] ?? null,
            'ical_export_url' => $statusTab['ical_export_url'] ?? null,
            'related_tour_ids' => $relatedTours,
            'is_fixed_date' => $availabilityData['is_fixed_date'] ?? 0,
            'is_open_hours' => $availabilityData['is_open_hours'] ?? 0,
            'is_fixed_date' => $availabilityData['is_fixed_date'] ?? 0,
            'start_date' => $availabilityData['start_date'],
            'end_date' => $availabilityData['end_date']  ?? null,
            'last_booking_date' => $availabilityData['last_booking_date'],
            'regular_price' => $pricing['regular_price']  ?? null,
            'sale_price' => $pricing['sale_price']  ?? null,
            'is_person_type_enabled' => $pricing['is_person_type_enabled'] ?? 0,
            'price_type' =>   isset($pricing['is_person_type_enabled']) && $pricing['is_person_type_enabled'] == 1 ? $pricing['price_type'] : null,
            'is_extra_price_enabled' => $pricing['is_extra_price_enabled'] ?? 0,
            'service_fee_price' => $pricing['service_fee_price']  ?? null,
            'show_phone' => $pricing['show_phone'] ?? 0,
            'phone_country_code' => $pricing['phone_country_code'] ?? null,
            'phone_number' => $pricing['phone_number']  ?? null,
        ]);

        // Handle FAQs
        if (isset($general['faq']['question']) && is_array($general['faq']['question'])) {
            foreach ($general['faq']['question'] as $index => $question) {
                $answer = $general['faq']['answer'][$index] ?? null;

                if (!empty($question) && !empty($answer)) {
                    TourFaq::create([
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
                if ($detail['name'] !== null && !empty($detail['items'])) {
                    TourDetail::create([
                        'tour_id' => $tour->id,
                        'name' => $detail['name'],
                        'items' => json_encode($detail['items']),
                    ]);
                }
            }
        }

        // Store Open Hours if is_open_hours is true
        if (isset($availabilityData['is_open_hours']) && $availabilityData['is_open_hours'] == 1) {
            foreach ($availabilityData['open_hours'] as $hours) {
                TourOpenHour::create([
                    'tour_id' => $tour->id,
                    'day' => $hours['day']??null,
                    'open_time' => $hours['open_time']??null,
                    'close_time' => $hours['close_time']??null,
                    'enabled' => $hours['enabled'] ?? 0,
                ]);
            }
        }

        // Check if discounts exist and save them
        if (!empty($pricing['discount'])) {

            $discountCount = count($pricing['discount']['people_from']);
            for ($i = 0; $i < $discountCount; $i++) {
                $peopleFrom = $pricing['discount']['people_from'][$i] ?? null;
                $peopleTo = $pricing['discount']['people_to'][$i] ?? null;
                $amount = $pricing['discount']['discount'][$i] ?? null;
                $type = $pricing['discount']['type'][$i] ?? null;

                TourPriceDiscount::create([
                    'tour_id' => $tour->id,
                    'people_from' => $peopleFrom,
                    'people_to' => $peopleTo,
                    'amount' => $amount,
                    'type' => $type,
                ]);
            }
        }


        if (isset($pricing['extra_price'])) {
            foreach ($pricing['extra_price'] as $extraPriceData) {
                if (isset($extraPriceData['name'], $extraPriceData['price'], $extraPriceData['type'])) {
                    TourExtraPrice::create([
                        'tour_id' => $tour->id,
                        'name' => $extraPriceData['name'],
                        'price' => $extraPriceData['price'],
                        'type' => $extraPriceData['type'],
                        'is_per_person' => $extraPriceData['is_per_person'] ?? 0,
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
        $tour = Tour::with(['attributes', 'attributes.attributeItems'])->find($id);
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

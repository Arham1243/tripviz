<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourAvailability;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    public function index()
    {
        // $tours = Tour::where('status', 'publish')->get();
        $tours = Tour::all();

        return view('admin.tours.availability.main', compact('tours'))->with('title', 'Tours Availability Calendar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'date_range' => 'required|string',
            'max_guest' => 'required|integer|min:1',
            'adult.min' => 'required|integer|min:0',
            'adult.max' => 'required|integer|min:0',
            'adult.price' => 'required|numeric|min:0',
            'child.min' => 'required|integer|min:0',
            'child.max' => 'required|integer|min:0',
            'child.price' => 'required|numeric|min:0',
        ]);

        $availability = new TourAvailability;
        $availability->tour_id = $request->tour_id;
        $availability->date_range = $request->date_range;
        $availability->max_guest = $request->max_guest;
        $availability->adult_min = $request->adult['min'];
        $availability->adult_max = $request->adult['max'];
        $availability->adult_price = $request->adult['price'];
        $availability->child_min = $request->child['min'];
        $availability->child_max = $request->child['max'];
        $availability->child_price = $request->child['price'];
        $availability->available_for_booking = $request->available_for_booking ? 1 : 0;
        $availability->save();

        return response()->json(['success' => true, 'message' => 'Tour availability saved successfully.']);
    }
}

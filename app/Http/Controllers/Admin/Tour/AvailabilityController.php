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
        try {
            $validatedData = $request->validate([
                'tour_id' => 'required|exists:tours,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'available_for_booking' => 'boolean',
                'max_guest' => 'required|integer|min:0',
                'adult' => 'required|array',
                'adult.min' => 'required|integer|min:0',
                'adult.max' => 'required|integer|min:0',
                'adult.price' => 'required|numeric|min:0',
                'child' => 'required|array',
                'child.min' => 'required|integer|min:0',
                'child.max' => 'required|integer|min:0',
                'child.price' => 'required|numeric|min:0',
            ]);

            $tourAvailability = new TourAvailability;
            $tourAvailability->tour_id = $validatedData['tour_id'];
            $tourAvailability->start_date = $validatedData['start_date'];
            $tourAvailability->end_date = $validatedData['end_date'];
            $tourAvailability->available_for_booking = $validatedData['available_for_booking'];
            $tourAvailability->max_guest = $validatedData['max_guest'];
            $tourAvailability->min_adult = $validatedData['adult']['min'];
            $tourAvailability->max_adult = $validatedData['adult']['max'];
            $tourAvailability->adult_price = $validatedData['adult']['price'];
            $tourAvailability->min_child = $validatedData['child']['min'];
            $tourAvailability->max_child = $validatedData['child']['max'];
            $tourAvailability->child_price = $validatedData['child']['price'];

            $tourAvailability->save();

            return redirect()->route('admin.tour-availability.index')->with('notify_success', 'Availability added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tour-availability.index')->with('notify_error', 'Error adding availability: '.$e->getMessage());
        }
    }
}

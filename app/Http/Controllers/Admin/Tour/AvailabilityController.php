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
                'available_for_booking' => 'nullable|boolean',
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

            $startDate = \Carbon\Carbon::parse($validatedData['start_date']);
            $endDate = \Carbon\Carbon::parse($validatedData['end_date']);

            if ($startDate->isSameDay($endDate)) {
                TourAvailability::updateOrCreate(
                    ['tour_id' => $validatedData['tour_id'], 'start_date' => $validatedData['start_date']],
                    [
                        'end_date' => $validatedData['end_date'],
                        'available_for_booking' => isset($validatedData['available_for_booking']) ? '1' : '0',
                        'max_guest' => $validatedData['max_guest'],
                        'min_adult' => $validatedData['adult']['min'],
                        'max_adult' => $validatedData['adult']['max'],
                        'adult_price' => $validatedData['adult']['price'],
                        'min_child' => $validatedData['child']['min'],
                        'max_child' => $validatedData['child']['max'],
                        'child_price' => $validatedData['child']['price'],
                    ]
                );
            } else {
                // Loop through each day in the range
                $dateRange = \Carbon\CarbonPeriod::create($startDate, $endDate);
                foreach ($dateRange as $date) {
                    TourAvailability::updateOrCreate(
                        ['tour_id' => $validatedData['tour_id'], 'start_date' => $date->toDateString()],
                        [
                            'end_date' => $date->toDateString(),
                            'available_for_booking' => isset($validatedData['available_for_booking']) ? '1' : '0',
                            'max_guest' => $validatedData['max_guest'],
                            'min_adult' => $validatedData['adult']['min'],
                            'max_adult' => $validatedData['adult']['max'],
                            'adult_price' => $validatedData['adult']['price'],
                            'min_child' => $validatedData['child']['min'],
                            'max_child' => $validatedData['child']['max'],
                            'child_price' => $validatedData['child']['price'],
                        ]
                    );
                }
            }

            return redirect()->back()->with('notify_success', 'Availability saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('notify_error', 'Error saving availability: '.$e->getMessage());
        }
    }
}

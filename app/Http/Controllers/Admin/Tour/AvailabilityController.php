<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourAvailability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        // $tours = Tour::where('status', 'publish')->get();
        $tours = Tour::all();

        return view('admin.tours.availability-calendar.main', compact('tours'))->with('title', 'Tours Availability Calendar');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'tour_id' => 'nullable|exists:tours,id',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'available_for_booking' => 'nullable|boolean',
                'max_guest' => 'nullable|integer|min:0',
                'adult' => 'nullable|array',
                'adult.min' => 'nullable|integer|min:0',
                'adult.max' => 'nullable|integer|min:0',
                'adult.price' => 'nullable|numeric|min:0',
                'child' => 'nullable|array',
                'child.min' => 'nullable|integer|min:0',
                'child.max' => 'nullable|integer|min:0',
                'child.price' => 'nullable|numeric|min:0',
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

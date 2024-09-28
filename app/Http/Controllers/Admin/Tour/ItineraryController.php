<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourItinerary;
use App\Traits\UploadImageTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItineraryController extends Controller
{
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maxDay = TourItinerary::where('tour_id', $request->input('tour_id'))->max('day');
        $nextDay = $maxDay ? $maxDay + 1 : 1;

        $data = $request->all();
        $data['day'] = $nextDay;

        $validator = Validator::make($data, [
            'tour_id' => 'required|exists:tours,id',
            'day' => 'required|integer',
            'title' => 'required|string',
            'short_desc' => 'required|string',
            'img_path' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'itineraries');
        }

        $tourItinerary = TourItinerary::create($data);

        $this->uploadImg('img_path', 'img_path', 'Tour/Itinerary', $tourItinerary);

        return redirect()->back()
            ->with('notify_success', 'Tour itinerary added successfully.')
            ->with('active_tab', 'itineraries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itinerary = TourItinerary::findOrFail($id);
        $tours = Tour::latest()->get(); // Assuming you have a Tour model

        return view('admin.tour.itineraries.edit', compact('itinerary', 'tours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $itinerary = TourItinerary::findOrFail($id);

            $request->validate([
                'title' => 'required|string',
                'short_desc' => 'required|string',
            ]);

            $itinerary->update($request->except('img_path'));

            $this->uploadImg('img_path', 'img_path', 'Tour/Itinerary', $itinerary);

            return redirect()->back()
                ->with('notify_success', 'Tour itinerary updated successfully.')
                ->with('active_tab', 'itineraries');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->with('notify_error', 'Tour itinerary not found.')
                ->with('active_tab', 'itineraries');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $itinerary = TourItinerary::findOrFail($id);
            $itinerary->delete();

            return redirect()->back()
                ->with('notify_success', 'Tour itinerary deleted successfully.')
                ->with('active_tab', 'itineraries');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->with('notify_error', 'Tour itinerary not found.')
                ->with('active_tab', 'itineraries');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $itinerary = TourItinerary::findOrFail($id);
            $itinerary->is_active = ! $itinerary->is_active;
            $itinerary->save();

            return redirect()->back()
                ->with('notify_success', 'Itinerary status updated successfully.')
                ->with('active_tab', 'itineraries');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->with('notify_error', 'Itinerary not found.')
                ->with('active_tab', 'itineraries');
        }
    }
}

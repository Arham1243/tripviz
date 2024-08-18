<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with('country')->get();

        return view('admin.cities-management.list', compact('cities'))->with('title', 'Cities');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('is_active', 1)->get();
        return view('admin.cities-management.add', compact('countries'))->with('title', 'Add New City');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|int',
            'name' => 'required|string|max:255',
        ]);

        City::create($request->all());

        return redirect()->route('admin.cities.index')->with('notify_success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('admin.cities-management.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::where('is_active', 1)->get();
        return view('admin.cities-management.edit', compact('city', 'countries'))->with('title', 'Edit City');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'country_id' => 'required|int',
            'name' => 'required|string|max:255',
        ]);

        $city->update($request->all());

        return redirect()->route('admin.cities.index')->with('notify_success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->route('admin.cities.index')->with('notify_success', 'City deleted successfully.');
    }

    public function suspend(City $city)
    {
        $city->is_active = !$city->is_active;
        $city->save();

        return redirect()->route('admin.cities.index')->with('notify_success', 'City status updated successfully.');
    }
}

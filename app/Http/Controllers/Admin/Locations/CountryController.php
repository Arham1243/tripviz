<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Continent;

class CountryController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::with('continent')->get();
        
        return view('admin.countries-management.list', compact('countries'))->with('title','Countries');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $continents = Continent::where('is_active',1)->get();
        return view('admin.countries-management.add',compact('continents'))->with('title','Add New Country');
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
            'continent_id' => 'required|int',
            'name' => 'required|string|max:255',
        ]);

        Country::create($request->all());

        return redirect()->route('admin.countries.index')
                         ->with('notify_success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('admin.countries-management.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
      $continents = Continent::where('is_active',1)->get();
        return view('admin.countries-management.edit', compact('country','continents'))->with('title','Edit Country');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
             'continent_id' => 'required|int',
            'name' => 'required|string|max:255',
        ]);

        $country->update($request->all());

        return redirect()->route('admin.countries.index')
                         ->with('notify_success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('admin.countries.index')
                         ->with('notify_success', 'Country deleted successfully.');
    }
    
     public function suspend(Country $country)
    {
        $country->is_active = !$country->is_active;
        $country->save();

        return redirect()->route('admin.countries.index')
                         ->with('notify_success', 'Country status updated successfully.');
    }
}

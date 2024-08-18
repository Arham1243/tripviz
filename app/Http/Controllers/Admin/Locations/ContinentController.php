<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Continent;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $continents = Continent::all();
        return view('admin.continents-management.list', compact('continents'))->with('title','Continents');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.continents-management.add')->with('title','Add New Continent');
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
            'name' => 'required|string|max:255',
        ]);

        Continent::create($request->all());

        return redirect()->route('admin.continents.index')
                         ->with('notify_success', 'Continent created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Continent  $continent
     * @return \Illuminate\Http\Response
     */
    public function show(Continent $continent)
    {
        return view('admin.continents-management.show', compact('continent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Continent  $continent
     * @return \Illuminate\Http\Response
     */
    public function edit(Continent $continent)
    {
        return view('admin.continents-management.edit', compact('continent'))->with('title','Edit Continent');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Continent  $continent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Continent $continent)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $continent->update($request->all());

        return redirect()->route('admin.continents.index')
                         ->with('notify_success', 'Continent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Continent  $continent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Continent $continent)
    {
        $continent->delete();

        return redirect()->route('admin.continents.index')
                         ->with('notify_success', 'Continent deleted successfully.');
    }
    
     public function suspend(Continent $continent)
    {
        $continent->is_active = !$continent->is_active;
        $continent->save();

        return redirect()->route('admin.continents.index')
                         ->with('notify_success', 'Continent status updated successfully.');
    }
}

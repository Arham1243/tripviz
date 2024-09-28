<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $continents = Continent::latest()->get();

        return view('admin.continents-management.list', compact('continents'))->with('title', 'Continents');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.continents-management.add')->with('title', 'Add New Continent');
    }

    /**
     * Store a newly created resource in storage.
     *
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
     * @return \Illuminate\Http\Response
     */
    public function show(Continent $continent)
    {
        return view('admin.continents-management.show', compact('continent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Continent $continent)
    {
        return view('admin.continents-management.edit', compact('continent'))->with('title', 'Edit Continent');
    }

    /**
     * Update the specified resource in storage.
     *
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
        $continent->is_active = ! $continent->is_active;
        $continent->save();

        return redirect()->route('admin.continents.index')
            ->with('notify_success', 'Continent status updated successfully.');
    }
}

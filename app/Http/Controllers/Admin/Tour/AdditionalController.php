<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\ToursAdditional;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toursAdditionals = ToursAdditional::latest()->get();

        return view('admin.tours-additionals.list', compact('toursAdditionals'))->with('title', 'Tours Additionals');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tours-additionals.add')->with('title', 'Add New Tour Additional');
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

        ToursAdditional::create($request->all());

        return redirect()->route('admin.tours-additionals.index')->with('notify_success', 'Tour Additional created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToursAdditional  $toursAdditional
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $toursAdditional = ToursAdditional::findOrFail($id);

            return view('admin.tours-additionals.show', compact('toursAdditional'))->with('title', 'Tour Additional Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours-additionals.index')->with('notify_error', 'Tour Additional not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToursAdditional  $toursAdditional
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $toursAdditional = ToursAdditional::findOrFail($id);

            return view('admin.tours-additionals.edit', compact('toursAdditional'))->with('title', 'Edit Tour Additional');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours-additionals.index')->with('notify_error', 'Tour Additional not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\ToursAdditional  $toursAdditional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $toursAdditional = ToursAdditional::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $toursAdditional->update($request->all());

            return redirect()->route('admin.tours-additionals.index')->with('notify_success', 'Tour Additional updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours-additionals.index')->with('notify_error', 'Tour Additional not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToursAdditional  $toursAdditional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $toursAdditional = ToursAdditional::findOrFail($id);
            $toursAdditional->delete();

            return redirect()->route('admin.tours-additionals.index')->with('notify_success', 'Tour Additional deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours-additionals.index')->with('notify_error', 'Tour Additional not found.');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  \App\Models\ToursAdditional  $toursAdditional
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $toursAdditional = ToursAdditional::findOrFail($id);
            $toursAdditional->is_active = ! $toursAdditional->is_active;
            $toursAdditional->save();

            return redirect()->route('admin.tours-additionals.index')->with('notify_success', 'Tour Additional status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours-additionals.index')->with('notify_error', 'Tour Additional not found.');
        }
    }
}

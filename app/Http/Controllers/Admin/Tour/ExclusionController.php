<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\TourExclusion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExclusionController extends Controller
{
    public function index()
    {
        $exclusions = TourExclusion::all();

        return view('admin.exclusions-management.list', compact('exclusions'))->with('title', 'Exclusions');
    }

    public function create()
    {
        return view('admin.exclusions-management.add')->with('title', 'Add New Exclusion');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'exclusions');
        }

        TourExclusion::create($request->all());

        return redirect()->back()->with('notify_success', 'Exclusion added successfully.')->with('active_tab', 'exclusions');
    }

    public function show($id)
    {
        try {
            $exclusion = TourExclusion::findOrFail($id);

            return view('admin.exclusions-management.show', compact('exclusion'))->with('title', 'Exclusion Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.exclusions.index')->with('notify_error', 'Exclusion not found.');
        }
    }

    public function edit($id)
    {
        try {
            $exclusion = TourExclusion::findOrFail($id);

            return view('admin.exclusions-management.edit', compact('exclusion'))->with('title', 'Edit Exclusion');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.exclusions.index')->with('notify_error', 'Exclusion not found.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $exclusion = TourExclusion::findOrFail($id);

            $request->validate([
                'title' => 'required|string',
            ]);

            $exclusion->update($request->all());

            return redirect()->back()->with('notify_success', 'Exclusion updated successfully.')->with('active_tab', 'exclusions');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Exclusion not found.')->with('active_tab', 'exclusions');
        }
    }

    public function destroy($id)
    {
        try {
            $exclusion = TourExclusion::findOrFail($id);
            $exclusion->delete();

            return redirect()->back()->with('notify_success', 'Exclusion deleted successfully.')->with('active_tab', 'exclusions');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Exclusion not found.')->with('active_tab', 'exclusions');
        }
    }

    public function suspend($id)
    {
        try {
            $exclusion = TourExclusion::findOrFail($id);
            $exclusion->is_active = ! $exclusion->is_active;
            $exclusion->save();

            return redirect()->back()->with('notify_success', 'Exclusion status updated successfully.')->with('active_tab', 'exclusions');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Exclusion not found.')->with('active_tab', 'exclusions');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourInclusion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InclusionController extends Controller
{
    public function index()
    {
        $inclusions = TourInclusion::all();
        return view('admin.inclusions-management.list', compact('inclusions'))->with('title', 'Inclusions');
    }

    public function create()
    {
        return view('admin.inclusions-management.add')->with('title', 'Add New Inclusion');
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
                ->with('active_tab', 'inclusions');
        }

        TourInclusion::create($request->all());

        return redirect()->back()->with('notify_success', 'Inclusion added successfully.')->with('active_tab', 'inclusions');
    }

    public function show($id)
    {
        try {
            $inclusion = TourInclusion::findOrFail($id);
            return view('admin.inclusions-management.show', compact('inclusion'))->with('title', 'Inclusion Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.inclusions.index')->with('notify_error', 'Inclusion not found.');
        }
    }

    public function edit($id)
    {
        try {
            $inclusion = TourInclusion::findOrFail($id);
            return view('admin.inclusions-management.edit', compact('inclusion'))->with('title', 'Edit Inclusion');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.inclusions.index')->with('notify_error', 'Inclusion not found.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $inclusion = TourInclusion::findOrFail($id);

            $request->validate([
                'title' => 'required|string',
            ]);

            $inclusion->update($request->all());

            return redirect()->back()->with('notify_success', 'Inclusion updated successfully.')->with('active_tab', 'inclusions');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Inclusion not found.')->with('active_tab', 'inclusions');
        }
    }

    public function destroy($id)
    {
        try {
            $inclusion = TourInclusion::findOrFail($id);
            $inclusion->delete();

            return redirect()->back()->with('notify_success', 'Inclusion deleted successfully.')->with('active_tab', 'inclusions');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Inclusion not found.')->with('active_tab', 'inclusions');
        }
    }

    public function suspend($id)
    {
        try {
            $inclusion = TourInclusion::findOrFail($id);
            $inclusion->is_active = !$inclusion->is_active;
            $inclusion->save();

            return redirect()->back()->with('notify_success', 'Inclusion status updated successfully.')->with('active_tab', 'inclusions');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Inclusion not found.')->with('active_tab', 'inclusions');
        }
    }
}

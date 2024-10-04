<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\TourAttribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = TourAttribute::latest()->get();
        $data = compact('items');

        return view('admin.tours.attributes.main')->with('title', 'Tour Attributes')->with($data);
    }

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
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);
        $attribute = TourAttribute::create($validatedData);

        return redirect()->route('admin.tour-attributes.edit', $attribute->id)->with('success', 'Attribute added successfully.');
    }

    public function edit($id)
    {
        $attribute = TourAttribute::find($id);
        $attribute->items = json_decode($attribute->items, true);
        $data = compact('attribute');

        return view('admin.tours.attributes.edit')->with('title', ucfirst(strtolower($attribute->name)))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'items' => 'nullable|array',
            'items.*' => 'nullable|string|min:3',
            'status' => 'required|in:active,inactive',
        ]);

        $attribute = TourAttribute::findOrFail($id);

        $validItems = array_filter($validatedData['items'], function ($item) {
            return ! is_null($item) && trim($item) !== '';
        });

        $attribute->update([
            'name' => $validatedData['name'],
            'items' => json_encode($validItems),
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('admin.tour-attributes.index')
            ->with('success', 'Attribute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $attribute = TourAttribute::findOrFail($id);
            $attribute->delete();

            return redirect()->back()
                ->with('notify_success', 'Tour attribute deleted successfully.')
                ->with('active_tab', 'attributes');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->with('notify_error', 'Tour attribute not found.')
                ->with('active_tab', 'attributes');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $attribute = TourAttribute::findOrFail($id);
            $attribute->is_active = ! $attribute->is_active;
            $attribute->save();

            return redirect()->back()
                ->with('notify_success', 'Attribute status updated successfully.')
                ->with('active_tab', 'attributes');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->with('notify_error', 'Attribute not found.')
                ->with('active_tab', 'attributes');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\TourAttribute;
use App\Models\TourAttributeItem;
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

    public function create() {}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|min:3|max:255',
        ]);
        $attribute = TourAttribute::create($validatedData);

        return redirect()->route('admin.tour-attributes.edit', $attribute->id)->with('success', 'Attribute added successfully.');
    }

    public function edit($id)
    {
        $attribute = TourAttribute::find($id);
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
            'name' => 'nullable|string|min:3|max:255',
            'items' => 'nullable|array',
            'items.*.id' => 'nullable|integer|exists:tour_attribute_items,id',
            'items.*.item' => 'nullable|string|min:3',
            'status' => 'nullable|in:active,inactive',
        ]);

        $attribute = TourAttribute::findOrFail($id);

        $validItems = array_filter($validatedData['items'], function ($item) {
            return ! is_null($item['item']) && trim($item['item']) !== '';
        });

        foreach ($validItems as $item) {
            if (isset($item['id']) && ! empty($item['id'])) {
                $attribute->attributeItems()->where('id', $item['id'])->update(['item' => $item['item']]);
            } else {
                $attribute->attributeItems()->create(['item' => $item['item']]);
            }
        }

        return redirect()->route('admin.tour-attributes.index')
            ->with('notify_success', 'Attribute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteItem($id)
    {
        try {
            $attribute = TourAttributeItem::findOrFail($id);
            $attribute->delete();

            return redirect()->back()
                ->with('notify_success', 'Attribute Item deleted successfully.')
                ->with('active_tab', 'attributes');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->with('notify_error', 'Attribute Item not found.')
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

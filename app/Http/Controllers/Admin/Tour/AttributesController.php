<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourAttribute;
use App\Models\Tour;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tour_id' => 'required|exists:tours,id',
            'title' => 'required|string',
            'icon_class' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('active_tab', 'attributes');
        }

        $data = $request->all();

        TourAttribute::create($data);

        return redirect()->back()
                         ->with('notify_success', 'Tour attribute added successfully.')
                         ->with('active_tab', 'attributes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $attribute = TourAttribute::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'icon_class' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                                 ->withErrors($validator)
                                 ->withInput()
                                 ->with('active_tab', 'attributes');
            }

            $attribute->update($request->all());

            return redirect()->back()
                             ->with('notify_success', 'Tour attribute updated successfully.')
                             ->with('active_tab', 'attributes');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                             ->with('notify_error', 'Tour attribute not found.')
                             ->with('active_tab', 'attributes');
        }
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
            $attribute->is_active = !$attribute->is_active;
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

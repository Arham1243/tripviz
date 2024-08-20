<?php
namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdditionalItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdditionalItemController extends Controller
{
    public function index()
    {
       
    }

    public function create()
    {
       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'tour_id' => 'required|exists:tours,id',
            'additional_id' => 'required|exists:tours_additionals,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'additional-items');
        }

        AdditionalItem::create($request->all());

        return redirect()->back()->with('notify_success', 'Additional Item added successfully.')->with('active_tab', 'additional-items');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
       
    }

    public function update(Request $request, $id)
    {
        try {
            $additionalItem = AdditionalItem::findOrFail($id);

            

            $additionalItem->update($request->all());

            return redirect()->back()->with('notify_success', 'Additional Item updated successfully.')->with('active_tab', 'additional-items');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Additional Item not found.')->with('active_tab', 'additional-items');
        }
    }

    public function destroy($id)
    {
        try {
            $additionalItem = AdditionalItem::findOrFail($id);
            $additionalItem->delete();

            return redirect()->back()->with('notify_success', 'Additional Item deleted successfully.')->with('active_tab', 'additional-items');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Additional Item not found.')->with('active_tab', 'additional-items');
        }
    }

    public function suspend($id)
    {
        try {
            $additionalItem = AdditionalItem::findOrFail($id);
            $additionalItem->is_active = !$additionalItem->is_active;
            $additionalItem->save();

            return redirect()->back()->with('notify_success', 'Additional Item status updated successfully.')->with('active_tab', 'additional-items');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Additional Item not found.')->with('active_tab', 'additional-items');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\ToursFaq;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = ToursFaq::all();

        return view('admin.tours-faqs-management.list', compact('faqs'))->with('title', 'FAQs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Filter tours where is_active = 1
        $tours = Tour::where('is_active', 1)->get();

        return view('admin.tours-faqs-management.add', compact('tours'))->with('title', 'Add New FAQ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer' => 'required|string',
            'tour_id' => 'nullable|exists:tours,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'faqs');
        }

        ToursFaq::create($request->all());

        return redirect()->back()->with('notify_success', 'FAQ added successfully.')->with('active_tab', 'faqs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToursFaq  $toursFaq
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $faq = ToursFaq::findOrFail($id);

            return view('admin.tours-faqs-management.show', compact('faq'))->with('title', 'FAQ Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours-faqs.index')->with('notify_error', 'FAQ not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToursFaq  $toursFaq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $faq = ToursFaq::findOrFail($id);
            // Filter tours where is_active = 1
            $tours = Tour::where('is_active', 1)->get();

            return view('admin.tours-faqs-management.edit', compact('faq', 'tours'))->with('title', 'Edit FAQ');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tours-faqs.index')->with('notify_error', 'FAQ not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\ToursFaq  $toursFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $faq = ToursFaq::findOrFail($id);

            $request->validate([
                'question' => 'required|string',
                'answer' => 'required|string',
                'tour_id' => 'nullable|exists:tours,id',
            ]);

            $faq->update($request->all());

            return redirect()->back()->with('notify_success', 'FAQ updated successfully.')->with('active_tab', 'faqs');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'FAQ not found.')->with('active_tab', 'faqs');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToursFaq  $toursFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $faq = ToursFaq::findOrFail($id);
            $faq->delete();

            return redirect()->back()->with('notify_success', 'FAQ deleted successfully.')->with('active_tab', 'faqs');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'FAQ not found.')->with('active_tab', 'faqs');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  \App\Models\ToursFaq  $toursFaq
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $faq = ToursFaq::findOrFail($id);
            $faq->is_active = ! $faq->is_active;
            $faq->save();

            return redirect()->back()->with('notify_success', 'FAQ status updated successfully.')->with('active_tab', 'faqs');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'FAQ not found.')->with('active_tab', 'faqs');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Traits\UploadImageTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    use UploadImageTrait; // Use the UploadImageTrait for image uploads

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::latest()->get();

        return view('admin.promotions-management.list', compact('promotions'))->with('title', 'Promotions');
    }

    public function create()
    {
        return view('admin.promotions-management.add')->with('title', 'Add New Promotion');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'img_path' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        $promotion = Promotion::create($request->except('img_path'));

        $this->uploadImg('img_path', 'img_path', 'Promotions/Thumbnail', $promotion);

        return redirect()->route('admin.promotions.index')->with('notify_success', 'Promotion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);

            return view('admin.promotions-management.show', compact('promotion'))->with('title', 'Promotion Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.promotions.index')->with('notify_error', 'Promotion not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);

            return view('admin.promotions-management.edit', compact('promotion'))->with('title', 'Edit Promotion');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.promotions.index')->with('notify_error', 'Promotion not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $promotion = Promotion::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'link' => 'required|url',
                'img_path' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            ]);

            $promotion->update($request->except('img_path'));

            $this->uploadImg('img_path', 'img_path', 'Promotions/Thumbnail', $promotion);

            return redirect()->route('admin.promotions.index')->with('notify_success', 'Promotion updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.promotions.index')->with('notify_error', 'Promotion not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            $promotion->delete();

            return redirect()->route('admin.promotions.index')->with('notify_success', 'Promotion deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.promotions.index')->with('notify_error', 'Promotion not found.');
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
            $promotion = Promotion::findOrFail($id);
            $promotion->is_active = ! $promotion->is_active;
            $promotion->save();

            return redirect()->route('admin.promotions.index')->with('notify_success', 'Promotion status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.promotions.index')->with('notify_error', 'Promotion not found.');
        }
    }
}

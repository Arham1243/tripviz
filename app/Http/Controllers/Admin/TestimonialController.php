<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\TestimonialImage;
use App\Traits\UploadImageTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use UploadImageTrait; // Include the UploadImageTrait

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();

        return view('admin.testimonials-management.list', compact('testimonials'))->with('title', 'Testimonials');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials-management.add')->with('title', 'Add New Testimonial');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer',
            'main_img_path' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',

        ]);

        $testimonial = Testimonial::create($request->except('main_img_path'));
        $this->uploadImg('main_img_path', 'main_img_path', 'Testimonial/Images', $testimonial);

        if ($request->hasFile('testimonial_images')) {
            $images = $request->file('testimonial_images');
            foreach ($images as $image) {
                $imagePath = $image->store('Testimonial/Images', 'public');
                TestimonialImage::create([
                    'testimonial_id' => $testimonial->id,
                    'img_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.testimonials.index')->with('notify_success', 'Testimonial created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            return view('admin.testimonials-management.show', compact('testimonial'))->with('title', 'Testimonial Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.testimonials.index')->with('notify_error', 'Testimonial not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $testimonial = Testimonial::with('images')->findOrFail($id);

            return view('admin.testimonials-management.edit', compact('testimonial'))->with('title', 'Edit Testimonial');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.testimonials.index')->with('notify_error', 'Testimonial not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'rating' => 'required|integer',
                'main_img_path' => 'nullable|image|mimes:jpeg,png,jpg,,webp,gif|max:2048',
            ]);

            $testimonial->update($request->except('main_img_path'));

            $this->uploadImg('main_img_path', 'main_img_path', 'Testimonial/Images', $testimonial);

            if ($request->hasFile('testimonial_images')) {
                $images = $request->file('testimonial_images');
                foreach ($images as $image) {
                    $imagePath = $image->store('Testimonial/Images', 'public');
                    TestimonialImage::create([
                        'testimonial_id' => $testimonial->id,
                        'img_path' => $imagePath,
                    ]);
                }
            }

            return redirect()->route('admin.testimonials.index')->with('notify_success', 'Testimonial updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.testimonials.index')->with('notify_error', 'Testimonial not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();

            return redirect()->route('admin.testimonials.index')->with('notify_success', 'Testimonial deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.testimonials.index')->with('notify_error', 'Testimonial not found.');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->is_active = ! $testimonial->is_active;
            $testimonial->save();

            return redirect()->route('admin.testimonials.index')->with('notify_success', 'Testimonial status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.testimonials.index')->with('notify_error', 'Testimonial not found.');
        }
    }

    public function deleteOtherImage($id)
    {
        try {
            $image = TestimonialImage::findOrFail($id);
            $image->delete();

            return redirect()->back()->with('notify_success', 'Image deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('notify_error', 'Image not found.');
        }
    }
}

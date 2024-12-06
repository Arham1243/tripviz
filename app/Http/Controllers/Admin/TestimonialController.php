<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    public function index()
    {
        $testimonials = Testimonial::latest()->get();

        return view('admin.testimonials-management.list', compact('testimonials'))->with('title', 'Testimonials');
    }

    public function create()
    {
        return view('admin.testimonials-management.add')->with('title', 'Add New Testimonial');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:60',
            'content' => 'required',
            'rating' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'featured_image_alt_text' => 'required|string',
            'status' => 'required|in:active,inactive',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'gallery_alt_texts' => 'nullable|array',
            'gallery_alt_texts.*' => 'string|max:255',
        ]);

        $slug = $this->createSlug($validatedData['title'], 'testimonials');

        $data = array_merge($validatedData, [
            'slug' => $slug,
            'featured_image' => $this->simpleUploadImg($validatedData['featured_image'], 'Testimonial/Featured-images'),
        ]);

        $testimonial = Testimonial::create($data);
        if ($request->gallery) {
            foreach ($request->file('gallery') as $index => $image) {
                $path = $this->simpleUploadImg($image, 'Testimonial/Other-images');

                $testimonial->media()->create([
                    'file_path' => $path,
                    'alt_text' => $validatedData['gallery_alt_texts'][$index],
                ]);
            }
        }

        return redirect()->route('admin.testimonials.index')->with('notify_success', 'Testimonial added successfully.');
    }

    public function edit($id)
    {
        $item = Testimonial::findOrFail($id);

        return view('admin.testimonials-management.edit', compact('item'))->with('title', ucfirst(strtolower($item->title)));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'featured_image_alt_text' => 'required|string',
            'status' => 'required|in:active,inactive',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'gallery_alt_texts' => 'nullable|array',
            'gallery_alt_texts.*' => 'string|max:255',
        ]);
        $featuredImage = $testimonial->featured_image;
        if ($request->hasFile('featured_image')) {
            $featuredImage = $this->simpleUploadImg($request->file('featured_image'), 'Testimonial/Featured-images', $testimonial->featured_image);
        }

        $slug = $this->createSlug($validatedData['title'], 'testimonials', $testimonial->slug);

        $data = array_merge($validatedData, [
            'slug' => $slug,
            'featured_image' => $featuredImage,
        ]);

        $testimonial->update($data);
        if ($request->gallery) {
            foreach ($request->file('gallery') as $index => $image) {
                $path = $this->simpleUploadImg($image, 'Testimonial/Other-images');

                $testimonial->media()->create([
                    'file_path' => $path,
                    'alt_text' => $validatedData['gallery_alt_texts'][$index],
                ]);
            }
        }

        return redirect()->route('admin.testimonials.index')->with('notify_success', 'Testimonial updated successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = BlogTag::latest()->get();
        $data = compact('tags');

        return view('admin.blogs-tags.main')->with('title', 'Blogs Tags')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_tags,slug',
        ]);
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'blog_tags');
        $data = array_merge($validatedData, ['slug' => $slug]);

        BlogTag::create($data);

        return redirect()->route('admin.blogs-tags.index')->with('notify_success', 'Tag Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = BlogTag::where('id', $id)->firstOrFail();
        $tags = BlogTag::latest()->get();
        $seo = $tag->seo()->first();
        $data = compact('tag', 'tags', 'seo');

        return view('admin.blogs-tags.edit')->with('title', ucfirst(strtolower($tag->name)))->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|min:3|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_tags,slug,'.$id,
        ]);
        $tag = BlogTag::where('id', $id)->firstOrFail();
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $newSlug = $this->createSlug($slugText, 'blog_tags', $tag->slug);
        $data = array_merge($validatedData, ['slug' => $newSlug]);
        $tag->update($data);

        $this->handleSeoData($request, $tag, 'Blog-Tags');

        return redirect()->route('admin.blogs-tags.index')->with('notify_success', 'Tag updated successfully.');
    }

    public function handleSeoData($request, $entry, $resource)
    {
        $seoData = $request->only([
            'is_seo_index',
            'seo_title',
            'seo_description',
            'fb_title',
            'fb_description',
            'tw_title',
            'tw_description',
            'schema',
            'canonical',
        ]);

        $seo = $entry->seo()->updateOrCreate([], $seoData);

        $imageFields = [
            'seo_featured_image',
            'fb_featured_image',
            'tw_featured_image',
        ];

        foreach ($imageFields as $field) {
            $this->uploadImg($field, "Seo/$resource/$field", $seo, $field);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

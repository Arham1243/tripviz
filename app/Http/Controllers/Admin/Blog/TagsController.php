<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use App\Traits\Sluggable;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    use Sluggable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = BlogTag::all();
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
            'name' => 'required|string|max:255',
        ]);
        $slug = $this->createSlug($validatedData['name'], 'blog_tags');

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
    public function edit(string $slug)
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();
        $tags = BlogTag::all();
        $data = compact('tag', 'tags');

        return view('admin.blogs-tags.main')->with('title', 'Edit Tag')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $tag = BlogTag::where('slug', $slug)->firstOrFail();
        $newSlug = $this->createSlug($validatedData['name'], 'blog_tags');
        $data = array_merge($validatedData, ['slug' => $newSlug]);
        $tag->update($data);

        return redirect()->route('admin.blogs-tags.index')->with('notify_success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

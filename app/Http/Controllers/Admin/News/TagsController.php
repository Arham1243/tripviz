<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\NewsTag;
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
        $tags = NewsTag::latest()->get();
        $data = compact('tags');

        return view('admin.news.tags.main')->with('title', 'News Tags')->with($data);
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
            'name' => 'nullable|min:3|max:255',
            'slug' => 'nullable|string|max:255',
        ]);
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'news_tags');
        $data = array_merge($validatedData, ['slug' => $slug]);

        NewsTag::create($data);

        return redirect()->route('admin.news-tags.index')->with('notify_success', 'Tag Added successfully.');
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
        $tag = NewsTag::where('id', $id)->firstOrFail();
        $tags = NewsTag::latest()->get();
        $seo = $tag->seo()->first();
        $data = compact('tag', 'tags', 'seo');

        return view('admin.news.tags.edit')->with('title', ucfirst(strtolower($tag->name)))->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|min:3|max:255',
            'slug' => 'nullable|string|max:255',
        ]);
        $tag = NewsTag::where('id', $id)->firstOrFail();
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $newSlug = $this->createSlug($slugText, 'news_tags', $tag->slug);
        $data = array_merge($validatedData, ['slug' => $newSlug]);
        $tag->update($data);

        handleSeoData($request, $tag, 'News-Tags');

        return redirect()->route('admin.news-tags.index')->with('notify_success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

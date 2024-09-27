<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use App\Models\Tour;
use App\Models\User;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->get();
        $data = compact('news');

        return view('admin.news-management.list')->with('title', 'All News')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tours = Tour::where('is_active', 1)->get();
        $categories = NewsCategory::where('is_active', 1)->get();
        $tags = NewsTag::where('is_active', 1)->get();
        $users = User::where('is_active', 1)->get();
        $data = compact('tours', 'categories', 'users', 'tags');

        return view('admin.news-management.add')->with('title', 'Add News')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:news_categories,id',
            'tags_ids' => 'array',
            'tags_ids.*' => 'integer|exists:news_tags,id',
            'featured_image' => 'required|image',
            'feature_image_alt_text' => 'required|string|max:255',
        ]);

        $slug = $this->createSlug($validatedData['title'], 'blogs');

        $data = array_merge($validatedData, [
            'slug' => $slug,
        ]);

        $news = News::create($data);

        if (! empty($validatedData['tags_ids'])) {
            $news->tags()->attach($validatedData['tags_ids']);
        }
        $this->uploadImg('featured_image', 'News/Featured-image', $news, 'featured_image');

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

        $news->seo()->create($seoData);
        $seo = $news->seo()->first();
        $this->uploadImg('seo_featured_image', 'Seo/News/Seo-Featured-image', $seo, 'seo_featured_image');
        $this->uploadImg('fb_featured_image', 'Seo/News/Fb-Featured-image', $seo, 'fb_featured_image');
        $this->uploadImg('tw_featured_image', 'Seo/News/Tw-Featured-image', $seo, 'tw_featured_image');

        return redirect()->route('admin.news.index')->with('notify_success', 'News Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog) {}

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog) {}

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog) {}

    public function suspend(Blog $blog) {}
}

<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogMedia;
use App\Models\BlogTag;
use App\Models\Tour;
use App\Models\User;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
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
        $blogs = Blog::latest()->get();
        $data = compact('blogs');

        return view('admin.blogs-management.list')->with('title', 'All Blogs')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tours = Tour::where('is_active', 1)->get();
        $categories = BlogCategory::where('is_active', 1)->get();
        $tags = BlogTag::where('is_active', 1)->get();
        $users = User::where('is_active', 1)->get();
        $data = compact('tours', 'categories', 'users', 'tags');

        return view('admin.blogs-management.add')->with('title', 'Add New Blog')->with($data);
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
            'top_highlighted_tour_id' => 'required|integer|exists:tours,id',
            'featured_tours_ids' => 'array|max:4',
            'featured_tours_ids.*' => 'required|integer|exists:tours,id',
            'status' => 'required|in:publish,draft',
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'tags_ids' => 'array',
            'tags_ids.*' => 'integer|exists:blog_tags,id',
            'featured_image' => 'required|image',
            'feature_image_alt_text' => 'nullable|string|max:255',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'gallery_alt_texts' => 'array',
            'gallery_alt_texts.*' => 'string|max:255',
        ]);

        $slug = $this->createSlug($validatedData['title'], 'blogs');

        $featuredToursIds = json_encode($validatedData['featured_tours_ids']);

        $data = array_merge($validatedData, [
            'slug' => $slug,
            'featured_tours_ids' => $featuredToursIds,
        ]);

        $blog = Blog::create($data);

        if (! empty($validatedData['tags_ids'])) {
            $blog->tags()->attach($validatedData['tags_ids']);
        }

        $this->uploadImg('featured_image', 'Blog/Featured-image', $blog, 'featured_image');

        if (! empty($validatedData['gallery'])) {
            $this->uploadMultipleImages(
                'gallery', // Input name for the images
                'Blog/Gallery', // Folder to store images
                new BlogMedia, // Pass the model class name here
                'image_path', // Column name for image path
                'alt_text', // Column name for alt text
                $validatedData['gallery_alt_texts'] ?? null, // Pass alt texts if provided
                'blog_id', // Pass the foreign key column name
                $blog->id // Pass the blog_id as the foreign key value
            );
        }

        $this->handleSeoData($request, $blog, 'Blog');

        return redirect()->route('admin.blogs.index')->with('notify_success', 'Blog Added successfully!');
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
    public function edit(Blog $blog)
    {
        $tours = Tour::where('is_active', 1)->get();
        $categories = BlogCategory::where('is_active', 1)->get();
        $tags = BlogTag::where('is_active', 1)->get();
        $users = User::where('is_active', 1)->get();
        $seo = $blog->seo()->first();
        $data = compact('tours', 'categories', 'users', 'tags', 'blog', 'seo');

        return view('admin.blogs-management.edit')->with('title', ucfirst(strtolower($blog->title)))->with($data);
    }

    public function deleteMedia(BlogMedia $media)
    {
        if (! $media) {
            return redirect()->back()->with('notify_error', 'Media not found');
        }
        $this->deletePreviousImage($media->image_path ?? null);
        $media->delete();

        return redirect()->back()->with('notify_success', 'Media deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required',
            'top_highlighted_tour_id' => 'required|integer|exists:tours,id',
            'featured_tours_ids' => 'array|max:4',
            'featured_tours_ids.*' => 'required|integer|exists:tours,id',
            'status' => 'required|in:publish,draft',
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'tags_ids' => 'array',
            'tags_ids.*' => 'integer|exists:blog_tags,id',
            'featured_image' => 'nullable|image',
            'feature_image_alt_text' => 'nullable|string|max:255',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'gallery_alt_texts' => 'array',
            'gallery_alt_texts.*' => 'string|max:255',
            'deleted_gallery_ids' => 'array',
            'deleted_gallery_ids.*' => 'integer|exists:blog_media,id',
        ]);

        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['title'];
        $slug = $this->createSlug($slugText, 'blogs', $blog->slug);

        $featuredToursIds = json_encode($validatedData['featured_tours_ids']);

        $data = array_merge($validatedData, [
            'slug' => $slug,
            'featured_tours_ids' => $featuredToursIds,
        ]);

        // Update the blog entry
        $blog->update($data);

        // Update tags
        if (! empty($validatedData['tags_ids'])) {
            $blog->tags()->sync($validatedData['tags_ids']);
        } else {
            $blog->tags()->detach();
        }
        $this->uploadImg('featured_image', 'Blog/Featured-image', $blog, 'featured_image');

        // Handle gallery images
        if (! empty($validatedData['gallery'])) {
            $this->uploadMultipleImages(
                'gallery',
                'Blog/Gallery',
                new BlogMedia,
                'image_path',
                'alt_text',
                $validatedData['gallery_alt_texts'] ?? null,
                'blog_id',
                $blog->id
            );
        }

        $this->handleSeoData($request, $blog, 'Blog');

        return redirect()->route('admin.blogs.index')->with('notify_success', 'Blog updated successfully!');
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
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog) {}

    public function suspend(Blog $blog) {}
}

<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Traits\BulkActionable;
use App\Traits\Sluggable;

class CategoriesController extends Controller
{
    use Sluggable;
    use BulkActionable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::all();
        $data = compact('categories');
        return view('admin.blogs-categories.main')->with('title', 'Blogs Categories')->with($data);
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
        $slug = $this->createSlug($validatedData['name'], 'blog_categories');

        $data = array_merge($validatedData, ['slug' => $slug]);

        BlogCategory::create($data);
        return redirect()->route('admin.blogs-categories.index')->with('notify_success', 'Category Added successfully.');
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
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $categories = BlogCategory::all();
        $data = compact('category', 'categories');
        return view('admin.blogs-categories.main')->with('title', 'Edit Category')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $newSlug = $this->createSlug($validatedData['name'], 'blog_categories');
        $data = array_merge($validatedData, ['slug' => $newSlug]);
        $category->update($data);

        return redirect()->route('admin.blogs-categories.index')->with('notify_success', 'Category updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bulkActions(Request $request)
    {
        $action = $request->input('bulk_actions');
        $selectedCategories = $request->input('bulk_select', []);

        return $this->handleBulkActions(BlogCategory::class, 'slug', $action, $selectedCategories, 'admin.blogs-categories.index');
    }
}

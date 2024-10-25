<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = NewsCategory::latest()->get();
        $data = compact('categories');

        return view('admin.news.categories.main')->with('title', 'News Categories')->with($data);
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
            'name' => 'required|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_category_id' => 'nullable|exists:news_categories,id',
        ]);

        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'news_categories');
        $data = array_merge($validatedData, ['slug' => $slug]);

        NewsCategory::create($data);

        return redirect()->route('admin.news.categories.index')->with('notify_success', 'Category Added successfully.');
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
        $category = NewsCategory::findOrFail($id);
        $categories = NewsCategory::whereNotIn('id', [$id])->get();
        $seo = $category->seo()->first();
        $data = compact('category', 'categories', 'seo');

        return view('admin.news.categories.edit')->with('title', ucfirst(strtolower($category->name)))->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_category_id' => 'nullable|exists:news_categories,id',
        ]);

        $category = NewsCategory::where('id', $id)->firstOrFail();
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['name'];
        $slug = $this->createSlug($slugText, 'news_categories', $category->slug);
        $data = array_merge($validatedData, ['slug' => $slug]);
        $category->update($data);

        handleSeoData($request, $category, 'News-Categories');

        return redirect()->route('admin.news.categories.index')->with('notify_success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

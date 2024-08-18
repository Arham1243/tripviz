<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories-management.list', compact('categories'))->with('title', 'Categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories-management.add')->with('title', 'Add New Category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('notify_success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories-management.show', compact('category'))->with('title', 'Category Details');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('notify_error', 'Category not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories-management.edit', compact('category'))->with('title', 'Edit Category');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('notify_error', 'Category not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category->update($request->all());

            return redirect()->route('admin.categories.index')->with('notify_success', 'Category updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('notify_error', 'Category not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.categories.index')->with('notify_success', 'Category deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('notify_error', 'Category not found.');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->is_active = !$category->is_active;
            $category->save();

            return redirect()->route('admin.categories.index')->with('notify_success', 'Category status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('notify_error', 'Category not found.');
        }
    }
}

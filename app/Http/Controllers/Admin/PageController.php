<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\Sluggable;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use Sluggable;

    public function index()
    {
        $pages = Page::latest()->get();
        $data = compact('pages');

        return view('admin.pages.pages-management.list')->with('title', 'All Pages')->with($data);
    }

    public function create()
    {
        return view('admin.pages.pages-management.add')->with('title', 'Add New Page');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'content' => 'required',
            'header_style' => 'required',
            'footer_style' => 'required',
            'status' => 'required|in:publish,draft',
        ]);

        $slug = $this->createSlug($validatedData['title'], 'pages');

        $data = array_merge($validatedData, [
            'slug' => $slug,
        ]);

        $page = Page::create($data);

        handleSeoData($request, $page, 'Page/'.$page->title);

        return redirect()->route('admin.pages.edit', $page->id)->with('notify_success', 'Page Added successfully!');
    }

    public function edit(Page $page)
    {
        $seo = $page->seo()->first();
        $data = compact('page', 'seo');

        return view('admin.pages.pages-management.edit')->with('title', ucfirst(strtolower($page->title)))->with($data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'header_style' => 'required',
            'footer_style' => 'required',
            'status' => 'required|in:publish,draft',
        ]);

        $page = Page::where('id', $id)->firstOrFail();
        $slugText = $validatedData['slug'] != '' ? $validatedData['slug'] : $validatedData['title'];
        $slug = $this->createSlug($slugText, 'pages', $page->slug);

        $data = array_merge($validatedData, [
            'slug' => $slug,
        ]);

        $page->update($data);

        handleSeoData($request, $page, 'Page/'.$page->title);

        return redirect()->route('admin.pages.index')->with('notify_success', 'Page updated successfully.');
    }

    public function editTemplate(Page $page)
    {
        return view('admin.pages.template-builder.main', compact('page'))->with('title', ucfirst(strtolower($page->title)));
    }
}

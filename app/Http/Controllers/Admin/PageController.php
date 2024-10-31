<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section;
use App\Models\Tour;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

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
        $tours = Tour::where('status', 'publish')->get();
        $sectionsGroups = Section::where('status', 'active')->get()->groupBy('category');
        $selectedSections = $page->sections->map(function ($section) {
            return [
                'id' => $section->id,
                'name' => $section->name,
                'section_key' => $section->section_key,
                'preview_image' => asset($section->preview_image),
                'template_path' => $section->template_path,
                'order' => $section->pivot->order,
            ];
        })->sortBy('order')
            ->values()
            ->toJson();

        return view('admin.pages.page-builder.main', compact('tours', 'page', 'sectionsGroups', 'selectedSections'))->with('title', ucfirst(strtolower($page->title)));
    }

    public function storeTemplate(Request $request, $id)
    {
        $request->validate([
            'sections.section_id' => 'required|array',
            'sections.order' => 'required|array',
        ]);

        $sectionIds = $request->input('sections.section_id');
        $orders = $request->input('sections.order');

        if (count($sectionIds) !== count($orders)) {
            return redirect()->route('admin.pages.index')->with('notify_error', 'Section IDs and order values do not match.');
        }

        $syncData = [];
        foreach ($sectionIds as $index => $sectionId) {
            $syncData[$sectionId] = ['order' => $orders[$index]];
        }

        $page = Page::findOrFail($id);
        $page->sections()->sync($syncData);

        return redirect()->back()->with('notify_success', 'Layout Saved Successfully!');
    }

    public function getSectionTemplate(Request $request)
    {
        $templatePath = $request->input('template_path');
        $componentView = "admin.pages.page-builder.sections.{$templatePath}";

        if (view()->exists($componentView)) {
            $tours = Tour::all();
            $html = view($componentView, compact('tours'));

            return $html;
        }

        return response()->json(['error' => 'Template not found'], 404);
    }

    public function saveSectionDetails(Request $request, $id)
    {
        dd($request->all(), $id);

        return redirect()->back()->with('notify_success', 'Section Details Successfully!');
    }
}

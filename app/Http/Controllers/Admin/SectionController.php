<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        $sections = Section::latest()->get();
        $data = compact('sections');

        return view('admin.sections-management.list')->with('title', 'All Sections')->with($data);
    }

    public function create()
    {
        return view('admin.sections-management.add')->with('title', 'Add New Section');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'nullable',
            'name' => 'nullable',
            'section_key' => 'nullable',
            'template_path' => 'nullable',
            'preview_image' => 'nullable',
            'status' => 'nullable|in:active,inactive',
        ]);

        $sectionKey = Str::slug($validatedData['section_key']);
        $sectionKey = str_replace('-', '_', $sectionKey);

        $validatedData['section_key'] = $sectionKey;

        $section = Section::create($validatedData);
        $this->uploadImg('preview_image', 'Sections/preview-images', $section, 'preview_image');

        return redirect()->route('admin.sections.index')->with('notify_success', 'Section Added successfully!');
    }

    public function edit($id)
    {
        $section = Section::find($id);
        $data = compact('section');

        return view('admin.sections-management.edit')->with('title', ucfirst(strtolower($section->name)))->with($data);
    }

    public function update(Request $request, Section $section)
    {
        $validatedData = $request->validate([
            'category' => 'nullable',
            'name' => 'nullable',
            'section_key' => 'nullable',
            'template_path' => 'nullable',
            'preview_image' => 'nullable',
            'status' => 'nullable|in:active,inactive',
        ]);

        $sectionKey = Str::slug($validatedData['section_key']);
        $sectionKey = str_replace('-', '_', $sectionKey);

        $validatedData['section_key'] = $sectionKey;

        $section->update($validatedData);

        $this->uploadImg('preview_image', 'Sections/preview-images', $section, 'preview_image');

        return redirect()->route('admin.sections.index')->with('notify_success', 'Section updated successfully!');
    }
}

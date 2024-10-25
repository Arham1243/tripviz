<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Traits\UploadImageTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::latest()->get();

        return view('admin.sections-management.list', compact('sections'))->with('title', 'Sections');
    }

    public function create()
    {
        return view('admin.sections-management.add')->with('title', 'Add New Section');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'section_name' => 'required',
            'preview_img' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        // Create the city record
        $section = Section::create([
            'section_name' => $request->section_name,
        ]);

        // Handle the image upload
        $this->uploadImg('preview_img', 'preview_img', 'Section/Preview', $section);

        return redirect()->route('admin.sections.index')->with('notify_success', 'Section Added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($section_name)
    {
        $section = Section::where('section_name', $section_name)->first();
        $section_name = ucwords(str_replace('_', ' ', $section->section_name));
        if ($section) {
            return view("admin.sections-management.sections.{$section->section_name}", compact('section'))
                ->with('title', "Edit {$section_name} Section");
        }

        return redirect()->route('admin.sections.index')->with('notify_error', 'Section not found.');
    }

    public function update(Request $request, Section $section)
    {
        $imageFields = ['bg_img', 'card_bg_1', 'card_bg_2', 'card_bg_3'];
        $section->update($request->except($imageFields));

        $this->uploadImg('bg_img', 'bg_img', "Section/{$section->section_name}/Bg-img", $section);
        $this->uploadImg('card_bg_1', 'card_bg_1', "Section/{$section->section_name}/card-iamges/Bg-img", $section);
        $this->uploadImg('card_bg_2', 'card_bg_2', "Section/{$section->section_name}/card-iamges/Bg-img", $section);
        $this->uploadImg('card_bg_3', 'card_bg_3', "Section/{$section->section_name}/card-iamges/Bg-img", $section);

        return redirect()->route('admin.sections.index')->with('notify_success', 'Section Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->delete();

            return redirect()->route('admin.sections.index')->with('notify_success', 'Section deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.sections.index')->with('notify_error', 'Section not found.');
        }
    }

    /**
     * Toggle the active status of the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->is_active = ! $section->is_active;
            $section->save();

            return redirect()->route('admin.sections.index')->with('notify_success', 'Section status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.sections.index')->with('notify_error', 'Section not found.');
        }
    }
}

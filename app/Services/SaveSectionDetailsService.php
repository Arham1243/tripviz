<?php

namespace App\Services;

use Illuminate\Http\Request;

class SaveSectionDetailsService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('page_sections');
    }

    public function processSection(Request $request, $sectionKey)
    {
        if (! isset($this->config[$sectionKey])) {
            throw new \Exception("Invalid section type: {$sectionKey}");
        }

        $sectionConfig = $this->config[$sectionKey];
        $sectionData = [];

        foreach ($sectionConfig['fields'] as $field => $type) {
            $sectionData[$field] = $this->handleField($request, $field, $type);
        }

        return $sectionData;
    }

    protected function handleField(Request $request, $field, $type)
    {
        if ($type === 'string') {
            return $request->input($field);
        } elseif ($type === 'array') {
            return $request->input($field, []);
        } elseif ($type === 'file') {
            return $request->hasFile($field) ? $this->uploadFile($request->file($field)) : null;
        } elseif ($type === 'file_array') {
            return $this->processFileArray($request->file($field));
        }

        return null;
    }

    protected function uploadFile($file)
    {
        $filename = uniqid().'.'.$file->getClientOriginalExtension();

        return $file->storeAs('uploads/section_images', $filename, 'public');
    }

    protected function processFileArray($files)
    {
        $paths = [];
        if ($files) {
            foreach ($files as $file) {
                $paths[] = $this->uploadFile($file);
            }
        }

        return $paths;
    }
}

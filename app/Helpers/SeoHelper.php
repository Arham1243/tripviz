<?php

namespace App\Helpers;

use App\Traits\UploadImageTrait;

class SeoHelper
{
    use UploadImageTrait;

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

        if ($request->is_seo_index != null) {
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
    }
}

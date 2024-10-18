<?php

namespace App\Helpers;

use App\Traits\UploadImageTrait;

class SeoHelper
{
    use UploadImageTrait;

    public function handleSeoData($request, $entry, $resource)
    {
        $seoData = $request->all('seo')['seo'];
        if (isset($seoData['is_seo_index'])) {

            $seo = $entry->seo()->updateOrCreate([], $seoData);
            $imageFields = [
                'seo_featured_image',
                'fb_featured_image',
                'tw_featured_image',
            ];

            foreach ($imageFields as $field) {
                if ($request->hasFile("seo.$field")) {
                    $this->uploadImg("seo.$field", "Seo/$resource/$field", $seo, $field);
                }
            }
        }
    }
}

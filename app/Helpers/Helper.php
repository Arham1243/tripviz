<?php

use App\Helpers\SeoHelper;

if (! function_exists('buildUrl')) {
    function buildUrl($base, $resource = null, $slug = null)
    {
        $url = $base;
        if ($resource) {
            $url .= '/'.$resource;
        }
        if ($slug) {
            $url .= '/'.$slug;
        }

        return $url;
    }
}

if (! function_exists('handleSeoData')) {
    function handleSeoData($request, $entry, $resource)
    {
        $seoHelper = new SeoHelper;
        $seoHelper->handleSeoData($request, $entry, $resource);
    }
}
if (! function_exists('formatDateTime')) {
    function formatDateTime($date)
    {
        return \Carbon\Carbon::parse($date)->format('M j, Y - g:i A');
    }
}

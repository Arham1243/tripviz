<?php

use App\Helpers\SeoHelper;
use Carbon\Carbon;

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
if (! function_exists('sanitizedLink')) {
    function sanitizedLink($url)
    {
        return '//'.preg_replace('/^(https?:\/\/)?(www\.)?/', '', $url);
    }
}
if (! function_exists('formatPrice')) {
    function formatPrice($price)
    {
        $formattedPrice = number_format($price, 2, '.', ',');

        return env('APP_CURRENCY').' '.$formattedPrice;
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
        return Carbon::parse($date)->format('M j, Y - g:i A');
    }
}
if (! function_exists('formatDate')) {
    function formatDate($date)
    {
        return Carbon::parse($date)->format('M j, Y');
    }
}
if (! function_exists('renderCategories')) {
    function renderCategories($categories, $selectedCategory = null, $parent_id = null, $level = 0)
    {
        foreach ($categories as $category) {
            if ($category->parent_category_id == $parent_id) {
                $selected = (old('category_id', $selectedCategory) == $category->id) ? 'selected' : '';

                echo '<option value="'.$category->id.'" '.$selected.'>';
                echo str_repeat('&nbsp;&nbsp;', $level).str_repeat('-', $level).' '.$category->name;
                echo '</option>';

                renderCategories($categories, $selectedCategory, $category->id, $level + 1);
            }
        }
    }
}

<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Generate a unique slug for a given title and table.
     *
     * @param  string  $title
     * @param  string  $table
     * @param  string|null  $currentSlug
     * @return string
     */
    public function createSlug($title, $table, $currentSlug = null)
    {
        if (! $title || str_contains($title, '#')) {
            return '#';
        }

        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (DB::table($table)->where('slug', $slug)
            ->when($currentSlug, function ($query) use ($currentSlug) {
                return $query->where('slug', '!=', $currentSlug);
            })->exists()) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}

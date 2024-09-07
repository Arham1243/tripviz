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
     * @return string
     */
    public function createSlug($title, $table)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (DB::table($table)->where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}

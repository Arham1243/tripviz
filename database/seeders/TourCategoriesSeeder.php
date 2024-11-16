<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TourCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Desert Safari', 'status' => 'publish', 'slug' => Str::slug('Desert Safari'), 'parent_category_id' => null],
            ['name' => 'Water Activities', 'status' => 'publish', 'slug' => Str::slug('Water Activities'), 'parent_category_id' => null],
            ['name' => 'Cultural Tours', 'status' => 'publish', 'slug' => Str::slug('Cultural Tours'), 'parent_category_id' => null],
            ['name' => 'City Tours', 'status' => 'publish', 'slug' => Str::slug('City Tours'), 'parent_category_id' => null],
            ['name' => 'Adventure Activities', 'status' => 'publish', 'slug' => Str::slug('Adventure Activities'), 'parent_category_id' => null],
            ['name' => 'Theme Parks', 'status' => 'publish', 'slug' => Str::slug('Theme Parks'), 'parent_category_id' => null],
            ['name' => 'Shopping Tours', 'status' => 'publish', 'slug' => Str::slug('Shopping Tours'), 'parent_category_id' => null],
            ['name' => 'Luxury Experiences', 'status' => 'publish', 'slug' => Str::slug('Luxury Experiences'), 'parent_category_id' => null],
            ['name' => 'Beach Activities', 'status' => 'publish', 'slug' => Str::slug('Beach Activities'), 'parent_category_id' => null],
            ['name' => 'Dhow Cruises', 'status' => 'publish', 'slug' => Str::slug('Dhow Cruises'), 'parent_category_id' => null],
            ['name' => 'Nightlife Experiences', 'status' => 'publish', 'slug' => Str::slug('Nightlife Experiences'), 'parent_category_id' => null],
            ['name' => 'Historical Tours', 'status' => 'publish', 'slug' => Str::slug('Historical Tours'), 'parent_category_id' => null],
            ['name' => 'Wildlife Tours', 'status' => 'publish', 'slug' => Str::slug('Wildlife Tours'), 'parent_category_id' => null],
            ['name' => 'Helicopter Rides', 'status' => 'publish', 'slug' => Str::slug('Helicopter Rides'), 'parent_category_id' => null],
            ['name' => 'Yacht Rentals', 'status' => 'publish', 'slug' => Str::slug('Yacht Rentals'), 'parent_category_id' => null],
            ['name' => 'Religious Tours', 'status' => 'publish', 'slug' => Str::slug('Religious Tours'), 'parent_category_id' => null],
            ['name' => 'Family-Friendly Tours', 'status' => 'publish', 'slug' => Str::slug('Family-Friendly Tours'), 'parent_category_id' => null],
            ['name' => 'Food and Culinary Tours', 'status' => 'publish', 'slug' => Str::slug('Food and Culinary Tours'), 'parent_category_id' => null],
        ];

        // Add Subcategories (Optional)
        $categories[] = ['name' => 'Overnight Safari', 'status' => 'publish', 'slug' => Str::slug('Overnight Safari'), 'parent_category_id' => 1];
        $categories[] = ['name' => 'Private Yacht Cruises', 'status' => 'publish', 'slug' => Str::slug('Private Yacht Cruises'), 'parent_category_id' => 15];
        $categories[] = ['name' => 'Camel Rides', 'status' => 'publish', 'slug' => Str::slug('Camel Rides'), 'parent_category_id' => 1];

        DB::table('tour_categories')->insert($categories);
    }
}

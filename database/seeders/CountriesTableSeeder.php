<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {

        $countries = [
            ['name' => 'France', 'status' => 'publish', 'slug' => Str::slug('France')],
            ['name' => 'United States', 'status' => 'publish', 'slug' => Str::slug('United States')],
            ['name' => 'Spain', 'status' => 'publish', 'slug' => Str::slug('Spain')],
            ['name' => 'China', 'status' => 'publish', 'slug' => Str::slug('China')],
            ['name' => 'Italy', 'status' => 'publish', 'slug' => Str::slug('Italy')],
            ['name' => 'Turkey', 'status' => 'publish', 'slug' => Str::slug('Turkey')],
            ['name' => 'Mexico', 'status' => 'publish', 'slug' => Str::slug('Mexico')],
            ['name' => 'Germany', 'status' => 'publish', 'slug' => Str::slug('Germany')],
            ['name' => 'Thailand', 'status' => 'publish', 'slug' => Str::slug('Thailand')],
            ['name' => 'United Kingdom', 'status' => 'publish', 'slug' => Str::slug('United Kingdom')],
            ['name' => 'Japan', 'status' => 'publish', 'slug' => Str::slug('Japan')],
            ['name' => 'Austria', 'status' => 'publish', 'slug' => Str::slug('Austria')],
            ['name' => 'Greece', 'status' => 'publish', 'slug' => Str::slug('Greece')],
            ['name' => 'Australia', 'status' => 'publish', 'slug' => Str::slug('Australia')],
            ['name' => 'Portugal', 'status' => 'publish', 'slug' => Str::slug('Portugal')],
            ['name' => 'Canada', 'status' => 'publish', 'slug' => Str::slug('Canada')],
            ['name' => 'Netherlands', 'status' => 'publish', 'slug' => Str::slug('Netherlands')],
            ['name' => 'Switzerland', 'status' => 'publish', 'slug' => Str::slug('Switzerland')],
            ['name' => 'Malaysia', 'status' => 'publish', 'slug' => Str::slug('Malaysia')],
            ['name' => 'Russia', 'status' => 'publish', 'slug' => Str::slug('Russia')],
            ['name' => 'Singapore', 'status' => 'publish', 'slug' => Str::slug('Singapore')],
            ['name' => 'South Korea', 'status' => 'publish', 'slug' => Str::slug('South Korea')],
            ['name' => 'Brazil', 'status' => 'publish', 'slug' => Str::slug('Brazil')],
            ['name' => 'Argentina', 'status' => 'publish', 'slug' => Str::slug('Argentina')],
            ['name' => 'South Africa', 'status' => 'publish', 'slug' => Str::slug('South Africa')],
            ['name' => 'Egypt', 'status' => 'publish', 'slug' => Str::slug('Egypt')],
            ['name' => 'India', 'status' => 'publish', 'slug' => Str::slug('India')],
            ['name' => 'Indonesia', 'status' => 'publish', 'slug' => Str::slug('Indonesia')],
            ['name' => 'Vietnam', 'status' => 'publish', 'slug' => Str::slug('Vietnam')],
            ['name' => 'New Zealand', 'status' => 'publish', 'slug' => Str::slug('New Zealand')],
            ['name' => 'Morocco', 'status' => 'publish', 'slug' => Str::slug('Morocco')],
            ['name' => 'Peru', 'status' => 'publish', 'slug' => Str::slug('Peru')],
            ['name' => 'Iceland', 'status' => 'publish', 'slug' => Str::slug('Iceland')],
            ['name' => 'United Arab Emirates', 'status' => 'publish', 'slug' => Str::slug('United Arab Emirates')],
            ['name' => 'Czech Republic', 'status' => 'publish', 'slug' => Str::slug('Czech Republic')],
            ['name' => 'Hungary', 'status' => 'publish', 'slug' => Str::slug('Hungary')],
            ['name' => 'Croatia', 'status' => 'publish', 'slug' => Str::slug('Croatia')],
        ];

        DB::table('countries')->insert($countries);
    }
}

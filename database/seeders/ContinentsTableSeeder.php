<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Seeder;

class ContinentsTableSeeder extends Seeder
{
    public function run()
    {
        $continents = [
            'Africa',
            'Asia',
            'Europe',
            'North America',
            'South America',
            'Australia/Oceania',
            'Antarctica',
        ];

        foreach ($continents as $continent) {
            Continent::create(['name' => $continent]);
        }
    }
}

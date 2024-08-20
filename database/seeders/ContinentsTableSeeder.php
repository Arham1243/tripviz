<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Continent;

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

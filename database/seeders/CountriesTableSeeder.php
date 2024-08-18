<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Continent;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $continents = Continent::all()->keyBy('name');

        $countries = [
            'Africa' => [
                'Nigeria',
                'Egypt',
                'South Africa',
            ],
            'Asia' => [
                'China',
                'India',
                'Japan',
                'United Arab Emirates',
            ],
            'Europe' => [
                'United Kingdom',
                'France',
                'Germany',
                'Italy',
            ],
            'North America' => [
                'United States',
                'Canada',
                'Mexico',
            ],
            'South America' => [
                'Brazil',
                'Argentina',
                'Chile',
            ],
            'Australia/Oceania' => [
                'Australia',
                'New Zealand',
            ],
            'Antarctica' => [
                'None', // No countries, but you might include research stations
            ],
        ];

        foreach ($countries as $continentName => $countryNames) {
            $continent = $continents->get($continentName);
            
            foreach ($countryNames as $countryName) {
                Country::create([
                    'name' => $countryName,
                    'continent_id' => $continent->id,
                ]);
            }
        }
    }
}

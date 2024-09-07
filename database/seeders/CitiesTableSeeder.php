<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = Country::all()->keyBy('name');

        $cities = [
            'Nigeria' => ['Lagos', 'Abuja', 'Kano'],
            'Egypt' => ['Cairo', 'Alexandria', 'Giza'],
            'South Africa' => ['Johannesburg', 'Cape Town', 'Durban'],
            'China' => ['Beijing', 'Shanghai', 'Guangzhou', 'Shenzhen'],
            'India' => ['New Delhi', 'Mumbai', 'Bengaluru', 'Chennai'],
            'Japan' => ['Tokyo', 'Osaka', 'Kyoto', 'Nagoya'],
            'United Arab Emirates' => ['Dubai', 'Sharjah', 'Ajman', 'Abu Dhabi'],
            'United Kingdom' => ['London', 'Manchester', 'Birmingham', 'Glasgow'],
            'France' => ['Paris', 'Marseille', 'Lyon', 'Toulouse'],
            'Germany' => ['Berlin', 'Munich', 'Frankfurt', 'Hamburg'],
            'Italy' => ['Rome', 'Milan', 'Naples', 'Turin'],
            'United States' => ['New York', 'Los Angeles', 'Chicago', 'Houston'],
            'Canada' => ['Toronto', 'Vancouver', 'Montreal', 'Calgary'],
            'Mexico' => ['Mexico City', 'Guadalajara', 'Monterrey', 'Cancun'],
            'Brazil' => ['São Paulo', 'Rio de Janeiro', 'Brasília', 'Salvador'],
            'Argentina' => ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza'],
            'Chile' => ['Santiago', 'Valparaíso', 'Concepción', 'La Serena'],
            'Australia' => ['Sydney', 'Melbourne', 'Brisbane', 'Perth'],
            'New Zealand' => ['Auckland', 'Wellington', 'Christchurch', 'Hamilton'],
        ];

        foreach ($cities as $countryName => $cityNames) {
            $country = $countries->get($countryName);

            foreach ($cityNames as $cityName) {
                City::create([
                    'name' => $cityName,
                    'country_id' => $country->id,
                ]);
            }
        }
    }
}

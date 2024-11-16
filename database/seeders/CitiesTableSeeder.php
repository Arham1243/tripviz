<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitiesTableSeeder extends Seeder
{
    public function run(): void
    {

        $cities = [
            // France
            ['name' => 'Paris', 'status' => 'publish', 'slug' => Str::slug('Paris'), 'country_id' => 1],
            ['name' => 'Nice', 'status' => 'publish', 'slug' => Str::slug('Nice'), 'country_id' => 1],
            ['name' => 'Lyon', 'status' => 'publish', 'slug' => Str::slug('Lyon'), 'country_id' => 1],

            // United States
            ['name' => 'New York City', 'status' => 'publish', 'slug' => Str::slug('New York City'), 'country_id' => 2],
            ['name' => 'Los Angeles', 'status' => 'publish', 'slug' => Str::slug('Los Angeles'), 'country_id' => 2],
            ['name' => 'Las Vegas', 'status' => 'publish', 'slug' => Str::slug('Las Vegas'), 'country_id' => 2],
            ['name' => 'Miami', 'status' => 'publish', 'slug' => Str::slug('Miami'), 'country_id' => 2],

            // Spain
            ['name' => 'Barcelona', 'status' => 'publish', 'slug' => Str::slug('Barcelona'), 'country_id' => 3],
            ['name' => 'Madrid', 'status' => 'publish', 'slug' => Str::slug('Madrid'), 'country_id' => 3],
            ['name' => 'Seville', 'status' => 'publish', 'slug' => Str::slug('Seville'), 'country_id' => 3],
            ['name' => 'Valencia', 'status' => 'publish', 'slug' => Str::slug('Valencia'), 'country_id' => 3],

            // China
            ['name' => 'Beijing', 'status' => 'publish', 'slug' => Str::slug('Beijing'), 'country_id' => 4],
            ['name' => 'Shanghai', 'status' => 'publish', 'slug' => Str::slug('Shanghai'), 'country_id' => 4],
            ['name' => 'Guangzhou', 'status' => 'publish', 'slug' => Str::slug('Guangzhou'), 'country_id' => 4],
            ['name' => 'Shenzhen', 'status' => 'publish', 'slug' => Str::slug('Shenzhen'), 'country_id' => 4],

            // Italy
            ['name' => 'Rome', 'status' => 'publish', 'slug' => Str::slug('Rome'), 'country_id' => 5],
            ['name' => 'Venice', 'status' => 'publish', 'slug' => Str::slug('Venice'), 'country_id' => 5],
            ['name' => 'Florence', 'status' => 'publish', 'slug' => Str::slug('Florence'), 'country_id' => 5],
            ['name' => 'Milan', 'status' => 'publish', 'slug' => Str::slug('Milan'), 'country_id' => 5],

            // Turkey
            ['name' => 'Istanbul', 'status' => 'publish', 'slug' => Str::slug('Istanbul'), 'country_id' => 6],
            ['name' => 'Antalya', 'status' => 'publish', 'slug' => Str::slug('Antalya'), 'country_id' => 6],
            ['name' => 'Cappadocia', 'status' => 'publish', 'slug' => Str::slug('Cappadocia'), 'country_id' => 6],
            ['name' => 'Izmir', 'status' => 'publish', 'slug' => Str::slug('Izmir'), 'country_id' => 6],

            // United Arab Emirates
            ['name' => 'Dubai', 'status' => 'publish', 'slug' => Str::slug('Dubai'), 'country_id' => 7],
            ['name' => 'Abu Dhabi', 'status' => 'publish', 'slug' => Str::slug('Abu Dhabi'), 'country_id' => 7],
            ['name' => 'Sharjah', 'status' => 'publish', 'slug' => Str::slug('Sharjah'), 'country_id' => 7],
            ['name' => 'Ajman', 'status' => 'publish', 'slug' => Str::slug('Ajman'), 'country_id' => 7],
            ['name' => 'Ras Al Khaimah', 'status' => 'publish', 'slug' => Str::slug('Ras Al Khaimah'), 'country_id' => 7],
            ['name' => 'Fujairah', 'status' => 'publish', 'slug' => Str::slug('Fujairah'), 'country_id' => 7],
            ['name' => 'Al Ain', 'status' => 'publish', 'slug' => Str::slug('Al Ain'), 'country_id' => 7],
            ['name' => 'Umm Al Quwain', 'status' => 'publish', 'slug' => Str::slug('Umm Al Quwain'), 'country_id' => 7],
            ['name' => 'Khor Fakkan', 'status' => 'publish', 'slug' => Str::slug('Khor Fakkan'), 'country_id' => 7],
            ['name' => 'Dibba Al-Fujairah', 'status' => 'publish', 'slug' => Str::slug('Dibba Al-Fujairah'), 'country_id' => 7],
            ['name' => 'Kalba', 'status' => 'publish', 'slug' => Str::slug('Kalba'), 'country_id' => 7],
            ['name' => 'Jebel Ali', 'status' => 'publish', 'slug' => Str::slug('Jebel Ali'), 'country_id' => 7],

            // Thailand
            ['name' => 'Bangkok', 'status' => 'publish', 'slug' => Str::slug('Bangkok'), 'country_id' => 8],
            ['name' => 'Phuket', 'status' => 'publish', 'slug' => Str::slug('Phuket'), 'country_id' => 8],
            ['name' => 'Chiang Mai', 'status' => 'publish', 'slug' => Str::slug('Chiang Mai'), 'country_id' => 8],
            ['name' => 'Pattaya', 'status' => 'publish', 'slug' => Str::slug('Pattaya'), 'country_id' => 8],

            // Australia
            ['name' => 'Sydney', 'status' => 'publish', 'slug' => Str::slug('Sydney'), 'country_id' => 9],
            ['name' => 'Melbourne', 'status' => 'publish', 'slug' => Str::slug('Melbourne'), 'country_id' => 9],
            ['name' => 'Brisbane', 'status' => 'publish', 'slug' => Str::slug('Brisbane'), 'country_id' => 9],
            ['name' => 'Perth', 'status' => 'publish', 'slug' => Str::slug('Perth'), 'country_id' => 9],

            // Egypt
            ['name' => 'Cairo', 'status' => 'publish', 'slug' => Str::slug('Cairo'), 'country_id' => 10],
            ['name' => 'Luxor', 'status' => 'publish', 'slug' => Str::slug('Luxor'), 'country_id' => 10],
            ['name' => 'Aswan', 'status' => 'publish', 'slug' => Str::slug('Aswan'), 'country_id' => 10],
            ['name' => 'Alexandria', 'status' => 'publish', 'slug' => Str::slug('Alexandria'), 'country_id' => 10],
        ];

        DB::table('cities')->insert($cities);

    }
}

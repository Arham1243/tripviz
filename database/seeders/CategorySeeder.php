<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Adventure',
            'Cultural',
            'Historical',
            'Relaxation',
            'Nature',
            'Cruise',
            'Family',
            'Luxury',
            'Budget',
            'Eco-Tourism',
        ];

        foreach ($categories as $categoryName) {
            Category::updateOrCreate(
                ['name' => $categoryName],
                ['is_active' => 1]
            );
        }
    }
}

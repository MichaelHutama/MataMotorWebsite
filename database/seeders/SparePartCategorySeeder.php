<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SparePartCategory;

class SparePartCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Engine and Parts',
            'Brake System',
            'Electrical Parts',
            'Suspension Parts',
            'Cooling System',
            'Fuel System',
            'Transmission System',
            'Wheel and Tire',
            'Body and Accessories',
            'Oil and Fluid',
            'Others'
        ];

        foreach ($categories as $name) {
            SparePartCategory::create([
                'SparePartCategoryName' => $name
            ]);
        }
    }
}
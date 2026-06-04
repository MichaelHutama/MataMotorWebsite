<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MechanicSeeder::class,
            ServiceCategorySeeder::class,
            SparePartCategorySeeder::class,
        ]);
    }
}

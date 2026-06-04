<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['ServiceCategoryName' => 'Oil and Filter Replacement', 'ServicePrice' => 150000],
            ['ServiceCategoryName' => 'Tune Up', 'ServicePrice' => 350000],
            ['ServiceCategoryName' => 'Machine Service', 'ServicePrice' => 500000],
            ['ServiceCategoryName' => 'Brake Service', 'ServicePrice' => 250000],
            ['ServiceCategoryName' => 'Air Conditioner Service', 'ServicePrice' => 300000],
            ['ServiceCategoryName' => 'Spooring', 'ServicePrice' => 200000],
            ['ServiceCategoryName' => 'Transmission Service', 'ServicePrice' => 600000],
            ['ServiceCategoryName' => 'Body Repair and Painting', 'ServicePrice' => 800000],
            ['ServiceCategoryName' => 'Wash and Detailing', 'ServicePrice' => 100000],
            ['ServiceCategoryName' => 'Tire Service', 'ServicePrice' => 100000],
            ['ServiceCategoryName' => 'Emergency Service', 'ServicePrice' => 400000],
        ];

        foreach ($categories as $cat) {
            ServiceCategory::create($cat);
        }
    }
}
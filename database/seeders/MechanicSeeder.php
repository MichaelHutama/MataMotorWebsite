<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Mechanic;

class MechanicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MEC-0 = Owner (seed manual, ID tidak ikut sequence)
        Mechanic::create([
            'MechanicID'   => 'MEC-0',
            'MechanicName' => 'Owner',
            'Number'       => '081310575396',
            'IsActive'     => true,
            'Password'     => Hash::make('owner123'),
        ]);
    }
}

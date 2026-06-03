<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mechanic;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Mechanic::create([
            'MechanicID' => 'MEC-0', // ID khusus Owner dalam bentuk Uppercase
            'MechanicName' => 'Owner MataMotor',
            'Number' => '081310575396',
            'IsActive' => true,
            'Password' => Hash::make('owner123'), // Password untuk login owner
        ]);
    }
}
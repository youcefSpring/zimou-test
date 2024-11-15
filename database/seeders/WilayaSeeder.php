<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilaya; // Assuming you have this model

class WilayaSeeder extends Seeder
{
    public function run()
    {
        // Example of creating Wilaya data
        Wilaya::create(['name' => 'Alger']);
        Wilaya::create(['name' => 'Oran']);
        Wilaya::create(['name' => 'Constantine']);
        // Add more wilayas as needed
    }
}

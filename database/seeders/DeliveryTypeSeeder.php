<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryType; // Assuming you have this model

class DeliveryTypeSeeder extends Seeder
{
    public function run()
    {
        // Example of creating DeliveryType data
        DeliveryType::create(['name' => 'Standard']);
        DeliveryType::create(['name' => 'Express']);
        DeliveryType::create(['name' => 'Overnight']);
        // Add more delivery types as needed
    }
}

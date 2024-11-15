<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commune; // Assuming you have this model

class CommuneSeeder extends Seeder
{
    public function run()
    {
        // Example of creating Commune data
        Commune::create(['name' => 'Commune 1', 'wilaya_id' => 1]);  // wilaya_id is assumed to be the foreign key to Wilaya
        Commune::create(['name' => 'Commune 2', 'wilaya_id' => 2]);
        Commune::create(['name' => 'Commune 3', 'wilaya_id' => 3]);
        // Add more communes as needed
    }
}

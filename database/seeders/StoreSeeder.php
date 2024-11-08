<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run()
    {
        // Generate stores
        Store::factory(5)->create();  // Create 5 stores
    }
}

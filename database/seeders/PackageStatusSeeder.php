<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PackageStatus; // Assuming you have this model

class PackageStatusSeeder extends Seeder
{
    public function run()
    {
        // Example of creating PackageStatus data
        $statuses = [
            ['name' => 'Pending'],
            ['name' => 'Shipped'],
            ['name' => 'Delivered'],
            ['name' => 'Returned'],
            ['name' => 'Cancelled'],
        ];

        // Insert all statuses into the database
        foreach ($statuses as $status) {
            PackageStatus::create($status);
        }
    }
}

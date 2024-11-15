<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    ini_set('max_execution_time',700);
        // Call all the seeders
        $this->call([
            DeliveryTypeSeeder::class,
            PackageStatusSeeder::class,
            WilayaSeeder::class,
            CommuneSeeder::class,
            UserSeeder::class,
            StoreSeeder::class,
            PackageSeeder::class,
        ]);
    }
}

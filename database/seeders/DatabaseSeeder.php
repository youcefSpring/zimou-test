<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call all the seeders
        $this->call([
            DeliveryTypeSeeder::class,
            PackageStatusSeeder::class,
            UserSeeder::class,
            StoreSeeder::class,
            PackageSeeder::class,
            WilayaSeeder::class,
            CommuneSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $stores = Store::all();  // Get all stores

        $packages = [];
        foreach ($stores as $store) {
            $storeId = $store->id;  // Get the store ID

            // Generate 3 packages for each store
            $storePackages = Package::factory(3)->make()->toArray();

            // Add store_id to each package
            foreach ($storePackages as $package) {
                $package['store_id'] = $storeId;
                $packages[] = $package;
            }
        }

        // Insert all packages in bulk
        DB::table('packages')->insert($packages);
    }
}

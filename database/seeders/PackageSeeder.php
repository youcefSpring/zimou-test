<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Store;

class PackageSeeder extends Seeder
{
    public function run()
    {
        // Retrieve all store IDs once
        $storeIds = Store::pluck('id')->toArray();

        // Array to hold all packages for batch insert
        $packages = [];
        $batchSize = 500; // Experiment with batch size (100, 500, or more)

        foreach (array_chunk($storeIds, 10) as $storeChunk) {
            foreach ($storeChunk as $store_id) {
                // Generate 100 packages for each store in the chunk
                for ($l = 0; $l < 100; $l++) {
                    $packages[] = [
                        'store_id' => $store_id,
                        'uuid' => fake()->uuid,
                        'tracking_code' => fake()->unique()->bothify('???######'),
                        'commune_id' => \DB::table('communes')->inRandomOrder()->value('id'),
                        'delivery_type_id' => \DB::table('delivery_types')->inRandomOrder()->value('id'),
                        'status_id' => 1,
                        'address' => fake()->address,
                        'can_be_opened' => fake()->boolean,
                        'name' => fake()->word,
                        'client_first_name' => fake()->firstName,
                        'client_last_name' => fake()->lastName,
                        'client_phone' => fake()->phoneNumber,
                        'client_phone2' => fake()->optional()->phoneNumber,
                        'cod_to_pay' => fake()->randomFloat(2, 0, 100),
                        'commission' => fake()->randomFloat(2, 0, 10),
                        'status_updated_at' => fake()->dateTime,
                        'delivered_at' => fake()->optional()->dateTime,
                        'delivery_price' => fake()->randomFloat(2, 5, 50),
                        'extra_weight_price' => fake()->randomNumber(3),
                        'free_delivery' => fake()->boolean,
                        'packaging_price' => fake()->randomNumber(2),
                        'partner_cod_price' => fake()->randomFloat(2, 0, 20),
                        'partner_delivery_price' => fake()->randomNumber(2),
                        'partner_return' => fake()->randomFloat(2, 0, 20),
                        'price' => fake()->randomFloat(2, 0, 100),
                        'price_to_pay' => fake()->randomFloat(2, 0, 100),
                        'return_price' => fake()->randomNumber(2),
                        'total_price' => fake()->randomFloat(2, 0, 200),
                        'weight' => fake()->numberBetween(500, 5000),
                    ];
                }
            }

            // Insert in batches to reduce DB transactions
            if (count($packages) >= $batchSize) {
                DB::table('packages')->insert($packages);
                $packages = []; // Reset the array after each batch insert
            }
        }

        // Insert any remaining packages
        if (!empty($packages)) {
            DB::table('packages')->insert($packages);
        }
    }
}

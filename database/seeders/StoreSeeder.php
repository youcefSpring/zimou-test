<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $stores = [];
        for ($i = 0; $i < 5000; $i++) {
            $stores[] = [
                'code' => fake()->unique()->bothify('???######'),
                'name' => fake()->company,
                'email' => fake()->unique()->safeEmail,
                'phones' => fake()->phoneNumber,
                'company_name' => fake()->company,
                'capital' => fake()->randomNumber(5),
                'address' => fake()->address,
                'register_commerce_number' => fake()->unique()->numerify('RC########'),
                'nif' => fake()->unique()->numerify('NIF########'),
                'legal_form' => 1,
                'status' => 1,
                'can_update_preparing_packages' => fake()->boolean,
            ];
        }

        // Insert all stores in bulk
        DB::transaction(function () use ($stores) {
            DB::table('stores')->insert($stores);
        });
    }
}

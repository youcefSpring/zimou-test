<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Store;
use App\Models\Package;

class StorePackageSeeder extends Seeder
{
    public function run()
    {
        // Load the JSON file from the public folder
        $json = Storage::disk('public')->get('stores_with_packages.json');

        // Decode the JSON data into an associative array
        $data = json_decode($json, true);

        DB::transaction(function () use ($data) {
            foreach ($data as $storeData) {
                // Create the Store record with the complete set of fields
                $store = Store::create([
                    'id' => $storeData['id'], // Use existing ID if needed
                    'code' => $storeData['code'],
                    'name' => $storeData['name'],
                    'email' => $storeData['email'],
                    'phones' => $storeData['phones'],
                    'company_name' => $storeData['company_name'],
                    'capital' => $storeData['capital'],
                    'address' => $storeData['address'],
                    'register_commerce_number' => $storeData['register_commerce_number'],
                    'nif' => $storeData['nif'],
                    'legal_form' => $storeData['legal_form'],
                    'status' => $storeData['status'],
                    'can_update_preparing_packages' => $storeData['can_update_preparing_packages'],
                ]);

                // Prepare Package records for the current store
                $packages = [];
                foreach ($storeData['packages'] as $packageData) {
                    $packages[] = [
                        'store_id' => $store->id,
                        'uuid' => $packageData['uuid'],
                        'tracking_code' => $packageData['tracking_code'],
                        'commune_id' => $packageData['commune_id'],
                        'delivery_type_id' => $packageData['delivery_type_id'],
                        'status_id' => $packageData['status_id'],
                        'address' => $packageData['address'],
                        'can_be_opened' => $packageData['can_be_opened'],
                        'name' => $packageData['name'],
                        'client_first_name' => $packageData['client_first_name'],
                        'client_last_name' => $packageData['client_last_name'],
                        'client_phone' => $packageData['client_phone'],
                        'client_phone2' => $packageData['client_phone2'],
                        'cod_to_pay' => $packageData['cod_to_pay'],
                        'commission' => $packageData['commission'],
                        'status_updated_at' => $packageData['status_updated_at'],
                        'delivered_at' => $packageData['delivered_at'],
                        'delivery_price' => $packageData['delivery_price'],
                        'extra_weight_price' => $packageData['extra_weight_price'],
                        'free_delivery' => $packageData['free_delivery'],
                        'packaging_price' => $packageData['packaging_price'],
                        'partner_cod_price' => $packageData['partner_cod_price'],
                        'partner_delivery_price' => $packageData['partner_delivery_price'],
                        'partner_return' => $packageData['partner_return'],
                        'price' => $packageData['price'],
                        'price_to_pay' => $packageData['price_to_pay'],
                        'return_price' => $packageData['return_price'],
                        'total_price' => $packageData['total_price'],
                        'weight' => $packageData['weight'],
                    ];
                }

                // Insert the packages in bulk for this store
                Package::insert($packages);
            }
        });
    }
}

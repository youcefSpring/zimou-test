<?php

namespace Database\Factories;
// database/factories/PackageFactory.php

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'tracking_code' => $this->faker->unique()->bothify('???######'),
            'commune_id' => 1, // Or use a dynamic ID if you have seeded communes
            'delivery_type_id' => 1, // Or use a dynamic ID if you have seeded delivery types
            'status_id' => 1, // Or use a dynamic ID if you have seeded package statuses
            'store_id' => 1, // This will be overwritten in the seeder
            'address' => $this->faker->address,
            'can_be_opened' => $this->faker->boolean,
            'name' => $this->faker->word,
            'client_first_name' => $this->faker->firstName,
            'client_last_name' => $this->faker->lastName,
            'client_phone' => $this->faker->phoneNumber,
            'client_phone2' => $this->faker->optional()->phoneNumber,
            'cod_to_pay' => $this->faker->randomFloat(2, 0, 100),
            'commission' => $this->faker->randomFloat(2, 0, 10),
            'status_updated_at' => $this->faker->dateTime,
            'delivered_at' => $this->faker->optional()->dateTime,
            'delivery_price' => $this->faker->randomFloat(2, 5, 50),
            'extra_weight_price' => $this->faker->randomNumber(3),
            'free_delivery' => $this->faker->boolean,
            'packaging_price' => $this->faker->randomNumber(2),
            'partner_cod_price' => $this->faker->randomFloat(2, 0, 20),
            'partner_delivery_price' => $this->faker->randomNumber(2),
            'partner_return' => $this->faker->randomFloat(2, 0, 20),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'price_to_pay' => $this->faker->randomFloat(2, 0, 100),
            'return_price' => $this->faker->randomNumber(2),
            'total_price' => $this->faker->randomFloat(2, 0, 200),
            'weight' => $this->faker->numberBetween(500, 5000),
        ];
    }
}


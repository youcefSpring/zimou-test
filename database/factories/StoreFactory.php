<?php

namespace Database\Factories;

// database/factories/StoreFactory.php

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->bothify('??#####'),
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'phones' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'capital' => $this->faker->randomNumber(5),
            'address' => $this->faker->address,
            'register_commerce_number' => $this->faker->unique()->numerify('RC#######'),
            'nif' => $this->faker->unique()->numerify('NIF#######'),
            'legal_form' => 1,
            'status' => 1,
            'can_update_preparing_packages' => $this->faker->boolean,
        ];
    }
}



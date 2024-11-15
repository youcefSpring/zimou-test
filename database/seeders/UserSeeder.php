<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' =>bcrypt('admin@gmail.com')
        ]);
    }
}

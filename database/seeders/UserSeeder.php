<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'email' => 'admin@gmail.com',
            'password' =>  '12345678',
            'created_at' => now(),
            'updated_at' => now(),
            'first_name' => 'admin',
            'role_id' => 1,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            Role::create([
                'id' => 1,
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Role::create([
                'id' => 2,
                'name' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

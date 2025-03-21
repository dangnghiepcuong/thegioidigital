<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            // CRUD on users
            Permission::create([
                'id' => 1,
                'operation' => 'create',
                'table' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 2,
                'operation' => 'read',
                'table' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 3,
                'operation' => 'update',
                'table' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 4,
                'operation' => 'delete',
                'table' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // CRUD on roles
            Permission::create([
                'id' => 5,
                'operation' => 'create',
                'table' => 'roles',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 6,
                'operation' => 'read',
                'table' => 'roles',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 7,
                'operation' => 'update',
                'table' => 'roles',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 8,
                'operation' => 'delete',
                'table' => 'roles',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // CRUD on permissions
            Permission::create([
                'id' => 9,
                'operation' => 'create',
                'table' => 'permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 10,
                'operation' => 'read',
                'table' => 'permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 11,
                'operation' => 'update',
                'table' => 'permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Permission::create([
                'id' => 12,
                'operation' => 'delete',
                'table' => 'permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

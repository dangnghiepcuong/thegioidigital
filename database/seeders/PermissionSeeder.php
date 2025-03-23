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
            Permission::firstOrCreate([
                'operation' => 'create',
                'table' => 'users',
            ]);

            Permission::firstOrCreate([
                'operation' => 'read',
                'table' => 'users',
            ]);

            Permission::firstOrCreate([
                'operation' => 'update',
                'table' => 'users',
            ]);

            Permission::firstOrCreate([
                'operation' => 'delete',
                'table' => 'users',
            ]);

            // CRUD on roles
            Permission::firstOrCreate([
                'operation' => 'create',
                'table' => 'roles',
            ]);

            Permission::firstOrCreate([
                'operation' => 'read',
                'table' => 'roles',
            ]);

            Permission::firstOrCreate([
                'operation' => 'update',
                'table' => 'roles',
            ]);

            Permission::firstOrCreate([
                'operation' => 'delete',
                'table' => 'roles',
            ]);

            // CRUD on permissions
            Permission::firstOrCreate([
                'operation' => 'create',
                'table' => 'permissions',
            ]);

            Permission::firstOrCreate([
                'operation' => 'read',
                'table' => 'permissions',
            ]);

            Permission::firstOrCreate([
                'operation' => 'update',
                'table' => 'permissions',
            ]);

            Permission::firstOrCreate([
                'operation' => 'delete',
                'table' => 'permissions',

            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

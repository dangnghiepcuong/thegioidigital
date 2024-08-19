<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
        
        // CRUD on permssions
        Permission::create([
            'id' => 9,
            'operation' => 'create',
            'table' => 'permssions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Permission::create([
            'id' => 10,
            'operation' => 'read',
            'table' => 'permssions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Permission::create([
            'id' => 11,
            'operation' => 'update',
            'table' => 'permssions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Permission::create([
            'id' => 12,
            'operation' => 'delete',
            'table' => 'permssions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

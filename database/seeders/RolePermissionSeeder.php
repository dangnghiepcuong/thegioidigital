<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionIds = Permission::pluck('id');

        $roleAdmin = Role::where('name', 'admin')->first();
        $roleAdmin->permissions()->attach($permissionIds);
    }
}

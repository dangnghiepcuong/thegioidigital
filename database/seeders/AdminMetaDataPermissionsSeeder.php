<?php

namespace Database\Seeders;

use App\Enums\ModelMetaKey;
use App\Enums\OperationEnum;
use App\Enums\TableEnum;
use App\Models\Permission;
use App\Models\UserMeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminMetaDataPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userMetaDataPermissions = UserMeta::firstOrCreate([
            'user_id' => 1,
            'key' => ModelMetaKey::USER_PERMISSIONS,
        ]);

        foreach (TableEnum::allCases() as $table) {
            foreach (OperationEnum::allCases() as $operation) {
                Permission::firstOrCreate([
                    'operation' => $operation,
                    'table' => $table,
                ]);
            }
        }

        $permissions = Permission::pluck('id');

        $serializedData = serialize(array_unique(
            array_merge(
                $permissions->toArray(),
                $userMetaDataPermissions->value ? unserialize($userMetaDataPermissions->value) : []
            ),
            SORT_REGULAR
        ));

        $userMetaDataPermissions->value = $serializedData;
        $userMetaDataPermissions->save();
    }
}

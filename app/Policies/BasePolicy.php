<?php

namespace App\Policies;

use App\Enums\ModelMetaKey;
use App\Enums\OperationEnum;
use App\Enums\TableEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

abstract class BasePolicy
{
    protected $table = null;
    protected function checkIfExistPermission(User $user, $operation)
    {
        DB::beginTransaction();
        $userMetaPermission = $user->userMeta(ModelMetaKey::USER_PERMISSIONS)->first();
        if ($userPermissionIds = unserialize($userMetaPermission->value)) {
            $permission = Permission::where('table', $this->table)
                ->where('operation', $operation)
                ->first();
            if ($permission && in_array($permission->id, $userPermissionIds)) {
                DB::commit();

                return true;
            }
        }

        DB::commit();
        return false;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->checkIfExistPermission($user, OperationEnum::READ);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $model = null): bool
    {
        return $this->viewAny($user);
    }

    public function write(User $user, $model = null): bool
    {
        return $this->writeAny($user);
    }

    public function writeAny(User $user): bool
    {
        return $this->checkIfExistPermission($user, OperationEnum::WRITE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->checkIfExistPermission($user, OperationEnum::CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $model = null): bool
    {
        return $this->checkIfExistPermission($user, OperationEnum::UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $model = null): bool
    {
        return $this->update($user, $model);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, $model = null): bool
    {
        return $this->update($user, $model);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, $model = null): bool
    {
        return $this->checkIfExistPermission($user, OperationEnum::DELETE);
    }
}

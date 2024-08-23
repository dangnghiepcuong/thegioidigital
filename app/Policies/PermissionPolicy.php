<?php

namespace App\Policies;

use App\Enums\TableEnum;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy extends BasePolicy
{
    protected $table = TableEnum::PERMISSIONS;
}

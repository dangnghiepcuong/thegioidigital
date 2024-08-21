<?php

namespace App\Policies;

use App\Enums\OperationEnum;
use App\Enums\TableEnum;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Auth\Access\Response;

class UserMetaPolicy extends BasePolicy
{
    protected $table = TableEnum::USER_META;
}

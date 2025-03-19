<?php

namespace App\Enums;
use App\Support\Traits\EnumAccessTrait;

final class RoleEnum
{
    use EnumAccessTrait;

    const ADMIN = 1;
    const USER = 2;
}

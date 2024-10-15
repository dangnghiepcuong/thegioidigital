<?php

namespace App\Enums;

use App\Support\Traits\EnumAccessTrait;

class ActionStatusEnum
{
    use EnumAccessTrait;

    public const WARNING = 'warning';
    public const ERROR = 'error';
    public const SUCCESS = 'success';
}

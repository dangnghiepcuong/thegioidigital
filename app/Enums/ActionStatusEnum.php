<?php

namespace App\Enums;

use App\Support\Traits\EnumAccessTrait;

final class ActionStatusEnum
{
    use EnumAccessTrait;

    public const WARNING = 'warning';
    public const ERROR = 'error';
    public const SUCCESS = 'success';
}

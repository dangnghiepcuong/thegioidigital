<?php

namespace App\Enums;

use App\Support\Traits\EnumAccessTrait;

final class BadgeBackgroundStyleEnum
{
    use EnumAccessTrait;

    const SOLID = 'solid';
    const LINEAR_TO_RIGHT = 'linear_to_right';
    const LINEAR_TO_LEFT = 'linear_to_left';
    const LINEAR_TO_TOP = 'linear_to_top';
    const LINEAR_TO_BOTTOM = 'linear_to_bottom';
    const RADIAL = 'radial';
    const URL = 'url';

    public static function gradientStyles(): array
    {
        return [
            self::LINEAR_TO_RIGHT,
            self::LINEAR_TO_LEFT,
            self::LINEAR_TO_TOP,
            self::LINEAR_TO_BOTTOM,
            self::RADIAL,
        ];
    }
}

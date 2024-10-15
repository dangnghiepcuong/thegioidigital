<?php

namespace App\Enums;
use App\Support\Traits\EnumAccessTrait;


final class ProductTypeEnum
{
    use EnumAccessTrait;

    const DTDD = 'dtdd';
    const LAPTOP = 'laptop';
    const TABLET = 'tablet';
    const PHUKIEN = 'phu_kien';
    const SMARTWATCH = 'smartwatch';
    const OLD_DEVICE = 'old_device';
    const PC = 'PC';
    const PRINTER = 'printer';
    const SIM = 'sim';
    const CARD = 'card';
}

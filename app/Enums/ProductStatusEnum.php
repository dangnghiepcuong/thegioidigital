<?php

namespace App\Enums;
use App\Support\Traits\EnumAccessTrait;

final class ProductStatusEnum
{
    use EnumAccessTrait;

    const IN_PROCESS = 'in_process';
    const IN_STOCK = 'in_stock';
    const OUT_OF_STOCK = 'out_of_stock';
    const STOP_FOR_SALE = 'stop_for_sale';
    const COMMING_SOON = 'comming_soon';
}

<?php

namespace App\Enums;

use ReflectionClass;

final class ProductStatusEnum
{
    const IN_PROCESS = 'in_process';
    const IN_STOCK = 'in_stock';
    const OUT_OF_STOCK = 'out_of_stock';
    const STOP_FOR_SALE = 'stop_for_sale';
    const COMMING_SOON = 'comming_soon';

    private static function getConstants()
    {
        $oClass = new ReflectionClass(self::class);

        return $oClass->getConstants();
    }

    public static function allCases()
    {
        $consts = self::getConstants();
        $array = [];
        foreach ($consts as $properties => $value) {
            array_push($array, $value);
        }

        return $array;
    }
}

<?php

namespace App\Enums;

use ReflectionClass;

final class ProductType
{
    const DTDD = 'dtdd';
    const LAPTOP = 'laptop';
    const TABLET = 'tablet';
    const PHUKIEN = 'phu_kien';
    const SMARTWATCH = 'smartwatch';
    const OLD_DEVICE = 'OLD_DEVICE';
    const PC = 'PC';
    const PRINTER = 'printer';
    const SIM = 'sim';
    const CARD = 'card';

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

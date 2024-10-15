<?php

namespace App\Support\Traits;

use ReflectionClass;

Trait EnumAccessTrait {
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

    public static function findCaseByValue($value)
    {
        $consts = self::getConstants();

        return array_filter($consts, function ($const) use ($value) {
            return $const === $value;
        })[0];
    }
}

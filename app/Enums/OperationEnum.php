<?php

namespace App\Enums;

use ReflectionClass;

final class OperationEnum
{
    const CREATE = 'create';
    const READ = 'read';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const WRITE = 'write';

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

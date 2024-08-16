<?php

namespace App\Enums;

use ReflectionClass;

final class TableEnum
{
    const attributes = 'attributes';
    const attribute_values = 'attribute_values';
    const likes = 'likes';
    const media = 'media';
    const permissions = 'permissions';
    const products = 'products';
    const product_meta = 'product_meta';
    const reviews = 'reviews';
    const roles = 'roles';
    const role_permission = 'role_permission';
    const terms = 'terms';
    const term_meta = 'term_meta';
    const term_relationships = 'term_relationships';
    const term_taxonomies = 'term_taxonomies';
    const users = 'users';

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

<?php

namespace App\Enums;

use Attribute;
use ReflectionClass;

final class TableEnum
{
    const ATTRIBUTE = 'attributes';
    const ATTRIBUTE_VALUES = 'attribute_values';
    const LIKES = 'likes';
    const MEDIA = 'media';
    const PERMISSIONS = 'permissions';
    const PRODUCTS = 'products';
    const PRODUCTS_META = 'product_meta';
    const REVIEWS = 'reviews';
    const ROLES = 'roles';
    const ROLE_PERMISSION = 'role_permission';
    const TERMS = 'terms';
    const TERMS_META = 'term_meta';
    const TERMS_RELATIONSHIPS = 'term_relationships';
    const TERM_TAXONOMIES = 'term_taxonomies';
    const USERS = 'users';
    const USER_META = 'user_meta';

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

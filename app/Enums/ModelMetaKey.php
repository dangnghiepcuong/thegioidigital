<?php

namespace App\Enums;

use ReflectionClass;

class ModelMetaKey
{
    public const USER_PERMISSIONS = 'user_permissions';
    public const RAM = 'product_attr_RAM';
    public const ROM = 'product_attr_ROM';
    public const COLOR = 'product_attr_color';
    public const SCREEN_SIZE = 'product_attr_screen_size';
    public const SCREEN_RESOLUTION = 'product_attr_screen_resolution';
    public const SCREEN_MATERIAL = 'product_attr_screen_material';
    public const PRICE = 'product_attr_price';
    public const BACK_CAMERA = 'product_attr_back_camera';
    public const FRONT_CAMERA = 'product_attr_front_camera';
    public const BATTERY = 'product_attr_battery';
    public const CHARGE_POWER = 'product_attr_charge_power';
    public const CPU = 'product_attr_CPU';
    public const MEMORY = 'product_attr_memory';
    public const BRAND = 'product_attr_brand';
    public const TOP_TAGS = 'product_attr_top_tags';
    public const GIFT = 'product_attr_gift';
    public const REGULAR_PRICE = 'product_attr_regular_price';
    public const THUMB_URL = 'product_attr_thumb_url';
    public const BOTTOM_LEFT_STAMP_URL = 'product_attr_bottom_left_stamp_url';
    public const TOP_RIGHT_STAMP_URL = 'product_attr_top_right_stamp_url';
    public const BADGE = 'product_attr_badge';
    public const COMPARE_TAGS = 'product_attr_compare_tags';
    public const STORAGE = 'product_attr_storage';

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

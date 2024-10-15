<?php

namespace App\Enums;

use App\Support\Traits\EnumAccessTrait;

class ModelMetaKey
{
    use EnumAccessTrait;

    public const USER_PERMISSIONS = 'user_permissions';
    public const BACK_CAMERA = 'product_attr_back_camera';
    public const BADGE = 'product_attr_badge';
    public const BATTERY = 'product_attr_battery';
    public const BOTTOM_LEFT_STAMP_URL = 'product_attr_bottom_left_stamp_url';
    public const BRAND = 'product_attr_brand';
    public const CHARGE_POWER = 'product_attr_charge_power';
    public const COLOR = 'product_attr_color';
    public const COMPARE_TAGS = 'product_attr_compare_tags';
    public const CPU = 'product_attr_CPU';
    public const FRONT_CAMERA = 'product_attr_front_camera';
    public const GIFT = 'product_attr_gift';
    public const MEMORY = 'product_attr_memory';
    public const PRICE = 'product_attr_price';
    public const RAM = 'product_attr_RAM';
    public const ROM = 'product_attr_ROM';
    public const REGULAR_PRICE = 'product_attr_regular_price';
    public const SCREEN_MATERIAL = 'product_attr_screen_material';
    public const SCREEN_RESOLUTION = 'product_attr_screen_resolution';
    public const SCREEN_SIZE = 'product_attr_screen_size';
    public const STORAGE = 'product_attr_storage';
    public const THUMB_URL = 'product_attr_thumb_url';
    public const TOP_RIGHT_STAMP_URL = 'product_attr_top_right_stamp_url';
    public const TOP_TAGS = 'product_attr_top_tags';

    public static function notShownInCardCases()
    {
        $array = [
            ModelMetaKey::RAM,
            ModelMetaKey::ROM,
            ModelMetaKey::STORAGE,
            ModelMetaKey::COLOR,
            ModelMetaKey::SCREEN_SIZE,
            ModelMetaKey::SCREEN_RESOLUTION,
            ModelMetaKey::SCREEN_MATERIAL,
            ModelMetaKey::BACK_CAMERA,
            ModelMetaKey::FRONT_CAMERA,
            ModelMetaKey::BATTERY,
            ModelMetaKey::CHARGE_POWER,
            ModelMetaKey::CPU,
            ModelMetaKey::MEMORY,
            ModelMetaKey::BRAND,
        ];

        natcasesort($array);

        return $array;
    }

    public static function inProductCardView()
    {
        $array= [
            ModelMetaKey::TOP_TAGS,
            ModelMetaKey::THUMB_URL,
            ModelMetaKey::BOTTOM_LEFT_STAMP_URL,
            ModelMetaKey::TOP_RIGHT_STAMP_URL,
            ModelMetaKey::BADGE,
            ModelMetaKey::COMPARE_TAGS,
            ModelMetaKey::REGULAR_PRICE,
            ModelMetaKey::PRICE,
            ModelMetaKey::GIFT,
        ];

        natcasesort($array);

        return $array;
    }

    public static function inPriorTerms()
    {
        $array = [
            ModelMetaKey::MEMORY,
            ModelMetaKey::STORAGE,
            ModelMetaKey::COLOR,
        ];

        natcasesort($array);

        return $array;
    }
}

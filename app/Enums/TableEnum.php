<?php

namespace App\Enums;
use App\Support\Traits\EnumAccessTrait;

final class TableEnum
{
    use EnumAccessTrait;

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
}

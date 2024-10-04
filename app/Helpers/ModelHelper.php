<?php

function get_meta($collection, $key = null)
{
    if (!isset($collection)) {
        return null;
    }

    if (isset($key)) {
        $meta = $collection->filter(function ($meta) use ($key) {
            return $meta->key === $key;
        })->first();

        return $meta;
    }

    return null;
}

function get_meta_value($collection, $key = null)
{
    $meta = get_meta($collection, $key);
    return $meta ? $meta->value : null;
}

function all_null_array($array)
{
    return empty(array_filter($array, function ($a) {
        return $a !== null && $a !== "";
    }));
}

function get_property($object, $property)
{
    if (!isset($object)) {
        return null;
    }

    return strval($object->$property);
}

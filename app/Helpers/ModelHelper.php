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

function all_null_array($array)
{
    return empty(array_filter($array, function ($a) { return $a !== null && $a !== "";}));
}

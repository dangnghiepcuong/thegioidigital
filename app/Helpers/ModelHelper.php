<?php

function get_meta($collection, $key = null)
{
    if (isset($key)) {
        $meta = $collection->filter(function ($meta) use ($key) {
            return $meta->key === $key;
        })->first();

        return $meta;
    }

    return null;
}

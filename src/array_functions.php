<?php

namespace Spatie;

/**
 * Get a random value from an array.
 *
 * @param array $array
 *
 * @return string
 */
function array_rand_value(array $array)
{
    if (! count($array)) {
        return;
    }

    $index = array_rand($array);

    return $array[$index];
}

<?php

namespace Spatie;

/**
 * Get a random value from an array.
 *
 * @param array $array
 *
 * @return mixed
 */
function array_rand_value(array $array)
{
    if (!count($array)) {
        return;
    }

    $index = array_rand($array);

    return $array[$index];
}

/**
 * Determine if all given needles are present in the haystack.
 *
 * @param array|string $needles
 * @param array $haystack
 *
 * @return bool
 */
function values_in_array($needles, array $haystack)
{
    if (!is_array($needles)) {
        $needles = [$needles];
    }

    return count(array_intersect($needles, $haystack)) == count($needles);
}

function array_rand_weighted(array $array)
{
    $options = [];

    foreach ($array as $option => $weight) {
        for ($i = 0; $i < $weight; ++$i) {
            $options[] = $option;
        }
    }

    return array_rand_value($options);
}

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
 * Get a random value from an array, with the ability to skew the results.
 * Example: array_rand_weighted(['foo' => 1, 'bar' => 2]) has a 66% chance of returning bar.
 * 
 * @param array $key
 * 
 * @return mixed
 */
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

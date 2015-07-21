<?php

namespace Spatie;

/**
 * Get a random value from an array.
 *
 * @param array $array
 * @param int $numReq  The amount of values to return
 *
 * @return mixed
 */
function array_rand_value(array $array, $numReq = 1)
{
    if (!count($array)) {
        return;
    }

    $keys = array_rand($array, $numReq);

    if ($numReq === 1) {
        return $array[$keys];
    }

    return array_intersect_key($array, array_flip($keys));
}

/**
 * Get a random value from an array, with the ability to skew the results.
 * Example: array_rand_weighted(['foo' => 1, 'bar' => 2]) has a 66% chance of returning bar.
 *
 * @param array $array
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

/**
 * Determine if all given needles are present in the haystack as array keys.
 *
 * @param array|string $needles
 * @param array $haystack
 *
 * @return bool
 */
function array_keys_exist($needles, array $haystack)
{
    if (!is_array($needles)) {
        return array_key_exists($needles, $haystack);
    }

    return values_in_array($needles, array_keys($haystack));
}

/**
 * Returns an array with two elements.
 *
 * Iterates over each value in the array passing them to the callback function.
 * If the callback function returns true, the current value from array is returned in the first
 * element of result array. If not, it is return in the second element of result array.
 *
 * Array keys are preserved.
 *
 * @param array $array
 * @param callable $callback
 *
 * @return array
 */
function array_split_filter(array $array, callable $callback)
{
    $passesFilter = array_filter($array, $callback);

    $negatedCallback = function ($item) use ($callback) { return ! $callback($item); };

    $doesNotPassFilter = array_filter($array, $negatedCallback);

    return [$passesFilter, $doesNotPassFilter];
}

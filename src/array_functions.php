<?php

namespace Spatie;

use Spatie\Support\Arr;

if (!function_exists('array_rand_value')) {
    /**
     * Get a random value from an array.
     *
     * @param array $array
     * @param int   $numReq The amount of values to return
     *
     * @return mixed
     */
    function array_rand_value(array $array, $numReq = 1)
    {
        return Arr::randValue($array, $numReq);
    }
}

if (!function_exists('array_rand_weighted')) {
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
        return Arr::randWeighted($array);
    }
}

if (!function_exists('values_in_array')) {
    /**
     * Determine if all given needles are present in the haystack.
     *
     * @param array|string $needles
     * @param array        $haystack
     *
     * @return bool
     */
    function values_in_array($needles, array $haystack)
    {
        return Arr::valuesInArray($needles, $haystack);
    }
}

if (!function_exists('array_keys_exist')) {
    /**
     * Determine if all given needles are present in the haystack as array keys.
     *
     * @param array|string $needles
     * @param array        $haystack
     *
     * @return bool
     */
    function array_keys_exist($needles, array $haystack)
    {
        return Arr::keysExist($needles, $haystack);
    }
}

if (!function_exists('array_split_filter')) {
    /**
     * Returns an array with two elements.
     *
     * Iterates over each value in the array passing them to the callback function.
     * If the callback function returns true, the current value from array is returned in the first
     * element of result array. If not, it is return in the second element of result array.
     *
     * Array keys are preserved.
     *
     * @param array    $array
     * @param callable $callback
     *
     * @return array
     */
    function array_split_filter(array $array, callable $callback)
    {
        return Arr::splitFilter($array, $callback);
    }
}

if (!function_exists('array_split')) {
    /**
     * Split an array in the given amount of pieces.
     *
     * @param array $array
     * @param int   $numberOfPieces
     * @param bool  $preserveKeys
     * @throws \InvalidArgumentException if the provided argument $numberOfPieces is lower than 1
     *
     * @return array
     */
    function array_split(array $array, $numberOfPieces = 2, $preserveKeys = false)
    {
        return Arr::split($array, $numberOfPieces, $preserveKeys);
    }
}

if (!function_exists('array_merge_values')) {
    /**
     * Returns an array with the unique values from all the given arrays.
     *
     * @param \array[] $arrays
     *
     * @return array
     */
    function array_merge_values(array...$arrays)
    {
        return Arr::mergeValues($arrays);
    }
}

if (!function_exists('array_flatten')) {
    /**
     * Flatten an array of arrays. The `$levels` parameter specifies how deep you want to
     * recurse in the array. If `$levels` is -1, the function will recurse infinitely.
     *
     * @param array $array
     * @param int   $levels
     *
     * @return array
     */
    function array_flatten(array $array, $levels = -1)
    {
        return Arr::flatten($array, $levels);
    }
}

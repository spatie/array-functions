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

/**
 * Divide an array into two arrays. One with keys and the other with values.
 *
 * @param array $array
 *
 * @return array
 */
function array_divide($array)
{
    return array(array_keys($array), array_values($array));
}

/**
 * Filter the array using the given Closure.
 *
 * @param array $array
 * @param \Closure $callback
 *
 * @return array
 */
function array_where($array, Closure $callback)
{
    $filtered = array();

    foreach ($array as $key => $value)
    {
        if (call_user_func($callback, $key, $value)) $filtered[$key] = $value;
    }

    return $filtered;
}

/**
 * Build a new array using a callback.
 *
 * @param  array     $array
 * @param  \Closure  $callback
 *
 * @return array
 */
function array_build($array, Closure $callback)
{
    $results = array();

    foreach ($array as $key => $value)
    {
        list($innerKey, $innerValue) = call_user_func($callback, $key, $value);
        $results[$innerKey] = $innerValue;
    }

    return $results;
}

/**
 * Flatten a multi-dimensional associative array with dots.
 *
 * @param  array   $array
 * @param  string  $prepend
 *
 * @return array
 */
function array_dot($array, $prepend = '')
{
    $results = array();

    foreach ($array as $key => $value)
    {
        if (is_array($value))
        {
            $results = array_merge($results, dot($value, $prepend.$key.'.'));
        }
        else
        {
            $results[$prepend.$key] = $value;
        }
    }

    return $results;
}

/**
 * Get all of the given array except for a specified array of items.
 *
 * @param  array  $array
 * @param  array|string  $keys
 *
 * @return array
 */
function array_except($array, $keys)
{
    return array_diff_key($array, array_flip((array) $keys));
}

/**
 * Return the first element in an array passing a given truth test.
 *
 * @param  array     $array
 * @param  \Closure  $callback
 * @param  mixed     $default
 *
 * @return mixed
 */
function array_first($array, $callback, $default = null)
{
    foreach ($array as $key => $value)
    {
        if (call_user_func($callback, $key, $value)) return $value;
    }

    return value($default);
}

/**
 * Flatten a multi-dimensional array into a single level.
 *
 * @param  array  $array
 *
 * @return array
 */
function array_flatten($array)
{
    $value = array();

    array_walk_recursive($array, function($x) use (&$return) { $return[] = $x; });

    return $value;
}
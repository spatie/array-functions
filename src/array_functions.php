<?php

namespace Spatie;

const CASE_LOWER = \CASE_LOWER;
const CASE_UPPER = \CASE_UPPER;
const CASE_SNAKE = 2;
const CASE_TITLE = 3;
const CASE_CAMEL = 4;
const CASE_PASCAL = 5;
const CASE_LISP = 6;

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
 * @param array        $haystack
 *
 * @return bool
 */
function values_in_array($needles, array $haystack)
{
    if (!is_array($needles)) {
        $needles = [$needles];
    }

    return count(array_intersect($needles, $haystack)) === count($needles);
}

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
 * @param array    $array
 * @param callable $callback
 *
 * @return array
 */
function array_split_filter(array $array, callable $callback)
{
    $passesFilter = array_filter($array, $callback);

    $negatedCallback = function ($item) use ($callback) { return !$callback($item); };

    $doesNotPassFilter = array_filter($array, $negatedCallback);

    return [$passesFilter, $doesNotPassFilter];
}

/**
 * Split an array in the given amount of pieces.
 *
 * @param array $array
 * @param int   $numberOfPieces
 * @param bool  $preserveKeys
 *
 * @return array
 */
function array_split(array $array, $numberOfPieces = 2, $preserveKeys = false)
{
    if (count($array) === 0) {
        return [];
    }

    $splitSize = ceil(count($array) / $numberOfPieces);

    return array_chunk($array, $splitSize, $preserveKeys);
}

/**
 * Returns an array with the unique values from all the given arrays.
 *
 * @param \array[] $arrays
 *
 * @return array
 */
function array_merge_values(array ...$arrays)
{
    $allValues = array_reduce($arrays, function ($carry, $array) {
         return array_merge($carry, $array);
    }, []);

    return array_values(array_unique($allValues));
}

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
    if ($levels === 0) {
        return $array;
    }

    $flattened = [];

    if ($levels !== -1) {
        --$levels;
    }

    foreach ($array as $element) {
        $flattened = array_merge(
            $flattened,
            is_array($element) ? array_flatten($element, $levels) : [$element]
        );
    }

    return $flattened;
}

/**
 * Very similar to \array_change_key_case, accepts more cases:
 * `CASE_LOWER`, `CASE_UPPER`, `CASE_SNAKE`, `CASE_TITLE`, `CASE_CAMEL`, `CASE_PASCAL`, `CASE_LISP`
 * all in the `Spatie` namespace.
 *
 * @param array $array
 * @param int   $case
 *
 * @return array
 */
function array_change_key_case(array $array, $case = CASE_LOWER)
{
    if ($case === CASE_LOWER || $case === CASE_UPPER) {
        return \array_change_key_case($array, $case);
    }

    // If case is invalid, no need to perform expensive operation.
    if (!is_int($case) || $case < CASE_SNAKE || $case > CASE_LISP) {
        return $array;
    }

    static $changeCase;
    $changeCase or $changeCase = function ($key, $case) {
        if (is_numeric($key)) {
            return $key;
        }

        // change "camelCase" to "camel Case", "foo123bar" to "foo 123 bar", "foo!bar" to "foo! bar"
        $key = preg_replace(
            [
                '/([^a-zA-Z0-9\s\_\-])([a-zA-Z0-9])/',
                '/([a-z])([A-Z])/',
                '/([a-zA-Z])([\d])/',
                '/([\d])([a-zA-Z])/',
            ],
            '${1} ${2}',
            $key
        );

        $words = preg_split('/_+|-+|\s+/', strtolower($key));

        switch ($case) {
            case CASE_SNAKE:
                return implode('_', $words);
            case CASE_TITLE:
                return ucfirst(implode(' ', $words));
            case CASE_CAMEL:
            case CASE_PASCAL:
                $first = $case === CASE_CAMEL ? array_shift($words) : '';
                return preg_replace_callback(
                    '/([^a-zA-Z]+)([a-zA-Z]{1})([^a-zA-Z]+)/',
                    function (array $matches) {
                        return $matches[1] . strtolower($matches[2]) . $matches[3];
                    },
                    $first . implode('', array_map('ucfirst', $words))
                );
            case CASE_LISP:
                return implode('-', $words);
            default:
                return $key;
        }
    };

    $changed = [];
    foreach ($array as $key => $value) {
        $changed[$changeCase($key, $case)]  = $value;
    }

    return $changed;
}

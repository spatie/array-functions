<?php

namespace Spatie\Support;

class Arr
{
    /**
     * Get a random value from an array.
     *
     * @param array $array
     * @param int   $numReq The amount of values to return
     *
     * @return mixed
     */
    public static function randValue(array $array, $numReq = 1)
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
     * Example: Arr::randWeighted(['foo' => 1, 'bar' => 2]) has a 66% chance of returning bar.
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function randWeighted(array $array)
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
    public static function valuesInArray($needles, array $haystack)
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
    public static function keysExist($needles, array $haystack)
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
    public static function splitFilter(array $array, callable $callback)
    {
        $passesFilter = array_filter($array, $callback);

        $negatedCallback = static function ($item) use ($callback) {return !$callback($item);};

        $doesNotPassFilter = array_filter($array, $negatedCallback);

        return [$passesFilter, $doesNotPassFilter];
    }

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
    public static function split(array $array, $numberOfPieces = 2, $preserveKeys = false)
    {
        if ($numberOfPieces <= 0) {
            throw new \InvalidArgumentException('Number of pieces parameter expected to be greater than 0');
        }

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
    public static function mergeValues(array...$arrays)
    {
        $allValues = array_reduce($arrays, static function ($carry, $array) {
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
    public static function flatten(array $array, $levels = -1)
    {
        if ($levels === 0) {
            return $array;
        }

        $flattened = [];

        if ($levels !== -1) {
            --$levels;
        }

        foreach ($array as $element) {
            $flattened[] = is_array($element) ? array_flatten($element, $levels) : [$element];
        }

        return array_merge([], ...$flattened);
    }
}

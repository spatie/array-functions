<?php

namespace Spatie;

use InvalidArgumentException;

/**
 * Get a random value from an array.
 *
 * @param int $numReq The amount of values to return
 *
 * @return array|mixed|null
 */
function array_rand_value(array $array, int $numReq = 1)
{
    $itemCount = count($array);

    if ($itemCount === 0) {
        return null;
    }

    if ($numReq < 1) {
        $numReq = 1;
    }

    if ($numReq > $itemCount) {
        $numReq = $itemCount;
    }

    if ($numReq === $itemCount) {
        shuffle($array);

        return $array;
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
 * @return int|string|null
 */
function array_rand_weighted(array $array)
{
    $array = array_filter($array, static fn ($item) => (int)$item >= 1);

    if (empty($array)) {
        return null;
    }
    $totalWeight = array_sum($array);

    foreach ($array as $value => $weight) {
        if (random_int(1, $totalWeight) <= $weight) {
            return $value;
        }
        $totalWeight -= $weight;
    }

    return null;
}

/**
 * Determine if all given needles are present in the haystack.
 *
 * @param array|string $needles
 */
function values_in_array($needles, array $haystack): bool
{
    if (empty($needles) && empty($haystack)) {
        return true;
    }

    if (! empty($needles) && empty($haystack)) {
        return false;
    }

    if (! is_array($needles)) {
        $needles = [$needles];
    }

    $lookup = array_flip($haystack);
    foreach ($needles as $needle) {
        if (! isset($lookup[$needle])) {
            return false;
        }
    }

    return true;
}

/**
 * Determine if all given needles are present in the haystack as array keys.
 *
 * @param array|string $needles
 */
function array_keys_exist($needles, array $haystack): bool
{
    if (! is_array($needles)) {
        return array_key_exists($needles, $haystack);
    }

    foreach ($needles as $needle) {
        if (! array_key_exists($needle, $haystack)) {
            return false;
        }
    }

    return true;
}

/**
 * Returns an array with two elements.
 *
 * Iterates over each value in the array passing them to the callback function.
 * If the callback function returns true, the current value from array is returned in the first
 * element of result array. If not, it is return in the second element of result array.
 *
 * Array keys are preserved.
 */
function array_split_filter(array $array, callable $callback): array
{
    $passesFilter = [];
    $doesNotPassFilter = [];

    foreach ($array as $key => $value) {
        if ($callback($value)) {
            $passesFilter[$key] = $value;
        } else {
            $doesNotPassFilter[$key] = $value;
        }
    }

    return [$passesFilter, $doesNotPassFilter];
}

/**
 * Split an array in the given amount of pieces.
 *
 * @throws InvalidArgumentException if the provided argument $numberOfPieces is lower than 1
 */
function array_split(array $array, int $numberOfPieces = 2, bool $preserveKeys = false): array
{
    if ($numberOfPieces <= 0) {
        throw new InvalidArgumentException('Number of pieces parameter expected to be greater than 0');
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
 * @param array[] $arrays
 */
function array_merge_values(array ...$arrays): array
{
    $allValues = array_reduce($arrays, static fn ($carry, $array) => [...$carry, ...$array], []);

    return array_values(array_unique($allValues));
}

/**
 * Flatten an array of arrays. The `$levels` parameter specifies how deep you want to
 * recurse in the array. If `$levels` is -1, the function will recurse infinitely.
 */
function array_flatten(array $array, int $levels = -1): array
{
    if ($levels === 0) {
        return $array;
    }

    $flattened = [];

    if ($levels !== -1) {
        $levels--;
    }

    foreach ($array as $element) {
        $flattened[] = is_array($element) ? array_flatten($element, $levels) : [$element];
    }

    return array_merge([], ...$flattened);
}

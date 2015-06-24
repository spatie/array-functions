<?php

namespace Spatie\Test;

use function spatie\array_keys_exist;

class ArrayKeysExistTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_returns_true_when_all_array_keys_exist()
    {
        $this->assertTrue(array_keys_exist(['a', 'b'], ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));
    }
    /**
     * @test
     */
    public function it_doenst_treat_values_as_keys()
    {
        $this->assertFalse(array_keys_exist(['a', 'b'], ['a', 'b', 'c']));
    }

    /**
     * @test
     */
    public function it_returns_false_when_not_all_needles_are_present_in_haystack()
    {
        $this->assertFalse(array_keys_exist(['a', 'b', 'd'], ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));
    }

    /**
     * @test
     */
    public function it_returns_true_for_empty_arrays()
    {
        $this->assertTrue(array_keys_exist([], []));
    }

    /**
     * @test
     */
    public function it_returns_true_for_empty_needles()
    {
        $this->assertTrue(array_keys_exist([], ['a', 'b', 'c']));
    }

    /**
     * @test
     */
    public function it_returns_false_for_searching_for_needles_in_an_empty_haystack()
    {
        $this->assertFalse(array_keys_exist(['a', 'b', 'c'], []));
    }

    /**
     * @test
     */
    public function it_returns_true_when_a_single_array_key_exists()
    {
        $this->assertTrue(array_keys_exist('a', ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));
        $this->assertTrue(array_keys_exist(['a'], ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));
    }

    /**
     * @test
     */
    public function it_returns_false_when_needle_is_not_present_in_haystack()
    {
        $this->assertFalse(array_keys_exist('d', ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));
        $this->assertFalse(array_keys_exist(['d'], ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']));
    }

}

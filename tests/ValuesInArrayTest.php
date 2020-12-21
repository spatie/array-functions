<?php

namespace Spatie\Test;

use PHPUnit\Framework\TestCase;
use function spatie\values_in_array;

class ValuesInArrayTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_true_when_all_needles_are_present_in_haystack()
    {
        $this->assertTrue(values_in_array(['a', 'b'], ['a', 'b', 'c']));
    }

    /**
     * @test
     */
    public function it_returns_false_when_not_all_needles_are_present_in_haystack()
    {
        $this->assertFalse(values_in_array(['a', 'b', 'd'], ['a', 'b', 'c']));
    }

    /**
     * @test
     */
    public function it_returns_true_for_empty_arrays()
    {
        $this->assertTrue(values_in_array([], []));
    }

    /**
     * @test
     */
    public function it_returns_true_for_empty_needles()
    {
        $this->assertTrue(values_in_array([], ['a', 'b', 'c']));
    }

    /**
     * @test
     */
    public function it_returns_false_for_searching_for_needles_in_an_empty_haystack()
    {
        $this->assertFalse(values_in_array(['a', 'b', 'c'], []));
    }

    /**
     * @test
     */
    public function it_returns_true_when_needle_is_present_in_haystack()
    {
        $this->assertTrue(values_in_array('a', ['a', 'b', 'c']));
        $this->assertTrue(values_in_array(['a'], ['a', 'b', 'c']));
    }

    /**
     * @test
     */
    public function it_returns_false_when_needle_is_not_present_in_haystack()
    {
        $this->assertFalse(values_in_array('d', ['a', 'b', 'c']));
        $this->assertFalse(values_in_array(['d'], ['a', 'b', 'c']));
    }
}

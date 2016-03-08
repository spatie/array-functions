<?php

namespace Spatie\Test;

use function spatie\array_flatten;

class ArrayFlattenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_flattens_an_array()
    {
        $this->assertEquals(
            ['a', 'b'],
            array_flatten(['a', ['b']])
        );
    }

    /**
     * @test
     */
    public function it_recursively_flattens_an_array()
    {
        $this->assertEquals(
            ['a', 'b', 'c', 'd', 'e'],
            array_flatten(['a', ['b', ['c'], 'd'], 'e'])
        );
    }

    /**
     * @test
     */
    public function it_recursively_flattens_an_array_to_a_certain_level()
    {
        $this->assertEquals(
            ['a', 'b', ['c'], 'd', 'e'],
            array_flatten(['a', ['b', ['c'], 'd'], 'e'], 1)
        );
    }

    /**
     * @test
     */
    public function it_doesnt_flatten_if_the_amount_of_levels_is_0()
    {
        $this->assertEquals(
            ['a', ['b', ['c'], 'd'], 'e'],
            array_flatten(['a', ['b', ['c'], 'd'], 'e'], 0)
        );
    }
}

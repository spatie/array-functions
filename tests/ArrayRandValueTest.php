<?php

namespace Spatie\Test;

use function spatie\array_rand_value;

class ArrayRandValueTest extends \PHPUnit_Framework_TestCase
{
    protected $testArray = [
        'one' => 'a',
        'two' => 'b',
        'three' => 'c'
    ];

    /**
     * @test
     */
    public function it_can_handle_an_empty_array()
    {
        $this->assertNull(array_rand_value([]));
    }

    /**
     * @test
     */
    public function it_can_get_a_random_value()
    {
        $testArrayValues = array_values($this->testArray);
        $randomArrayValue = array_rand_value($this->testArray);

        $this->assertTrue(in_array($randomArrayValue, $testArrayValues));
    }
}

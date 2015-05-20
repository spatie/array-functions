<?php

namespace Spatie\Test;

class ExampleTest extends \PHPUnit_Framework_TestCase
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
        $this->assertNull(\spatie\array_rand_value([]));
    }

    /**
     * @test
     */
    public function it_can_get_a_random_value()
    {
        $testArrayValues = array_values($this->testArray);
        $randomArrayValue = \spatie\array_rand_value($this->testArray);

        $this->assertTrue(in_array($randomArrayValue, $testArrayValues));
    }
}

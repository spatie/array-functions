<?php

namespace Spatie\Test;

use PHPUnit\Framework\TestCase;
use function spatie\array_rand_weighted;

class ArrayRandWeightedTest extends TestCase
{
    protected $testArray = [
        'foo' => 1,
        'bar' => 1,
        'baz' => 4,
    ];

    /**
     * @test
     */
    public function it_can_handle_an_empty_array()
    {
        $this->assertNull(array_rand_weighted([]));
    }

    /**
     * @test
     */
    public function it_retrieves_a_value_from_the_array()
    {
        $this->assertContains(array_rand_weighted($this->testArray), array_keys($this->testArray));
    }

    /**
     * @test
     */
    public function it_is_safe_to_assume_the_result_is_weighted()
    {
        $results = [];

        for ($i = 0; $i < 100; ++$i) {
            $results[] = array_rand_weighted($this->testArray);
        }

        $resultCounts = array_count_values($results);

        $this->assertGreaterThan($resultCounts['foo'] + $resultCounts['bar'], $resultCounts['baz']);
    }
}

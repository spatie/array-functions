<?php

namespace Spatie\Test;

use function spatie\array_merge_values;
use PHPUnit\Framework\TestCase;

class ArrayMergeValuesTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_handle_an_empty_array()
    {
        $this->assertSame(array_merge_values([]), []);
    }

    /**
     * @test
     */
    public function it_can_merge_multiple_arrays()
    {
        $this->assertSame(array_merge_values([1, 2], [3, 4]), [1, 2, 3, 4]);

        $this->assertSame(array_merge_values([1, 2], [3, 4], [5, 6]), [1, 2, 3, 4, 5, 6]);
    }

    /**
     * @test
     */
    public function it_will_return_unique_values()
    {
        $this->assertSame(array_merge_values([1, 2, 3], [2, 3, 4]), [1, 2, 3, 4]);

        $this->assertSame(array_merge_values([1, 1, 1], [2, 2, 2]), [1, 2]);
    }
}

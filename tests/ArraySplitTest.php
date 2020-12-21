<?php

namespace Spatie\Test;

use PHPUnit\Framework\TestCase;
use function spatie\array_split;

class ArraySplitTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_handle_an_empty_array()
    {
        $this->assertSame(array_split([]), []);
    }

    /**
     * @dataProvider argumentsProvider
     * @test
     */
    public function it_throws_exception_when_second_parameter_is_lower_than_1($numberOfPieces, $mustThrow)
    {
        $exception = null;

        try {
            array_split([], $numberOfPieces);
        } catch (\InvalidArgumentException $exception) {
        }

        $this->assertSame($mustThrow, $exception instanceof \InvalidArgumentException);
    }

    public function argumentsProvider()
    {
        return [
          [2 , false],
          [1 , false],
          [0 , true],
          [-1 , true],
          [-2 , true],
        ];
    }

    /**
     * @test
     */
    public function it_splits_an_array_in_two_by_default()
    {
        $this->assertSame(array_split(['a', 'b']), [['a'], ['b']]);
    }

    /**
     * @test
     */
    public function it_splits_an_array_in_two_by_default_while_preserving_keys()
    {
        $this->assertSame(array_split(['a' => 1, 'b' => 2], 2, true), [['a' => 1], ['b' => 2]]);
    }

    /**
     * @dataProvider arrayProvider
     *
     * @test
     *
     * @param $array
     * @param $splitIntoNumber
     * @param $expectedArray
     */
    public function it_can_split_an_array_in_equal_pieces($array, $splitIntoNumber, $expectedArray)
    {
        $this->assertSame($expectedArray, array_split($array, $splitIntoNumber));
    }

    public function arrayProvider()
    {
        return [
            [
                ['a', 'b', 'c', 'd'], 2, [['a', 'b'], ['c', 'd']],
            ],
            [
                ['a', 'b', 'c', 'd', 'e'], 2, [['a', 'b', 'c'], ['d', 'e']],
            ],
            [
                ['a', 'b', 'c', 'd', 'e'], 3, [['a', 'b'], ['c', 'd'], ['e']],
            ],
        ];
    }
}

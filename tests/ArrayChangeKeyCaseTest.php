<?php

namespace Spatie\Test;

use const Spatie\CASE_LOWER;
use const Spatie\CASE_UPPER;
use const Spatie\CASE_SNAKE;
use const Spatie\CASE_TITLE;
use const Spatie\CASE_CAMEL;
use const Spatie\CASE_PASCAL;
use const Spatie\CASE_LISP;
use function Spatie\array_change_key_case;
use PHPUnit\Framework\TestCase;


class ArrayChangeKeyCaseTest extends TestCase
{
    const SAMPLE_ARRAY = [
        'oneKeyUsingCamelCase' => 1,
        'OneKeyUsingPascalCase' => 1,
        'one key with spaces' => 1,
        'one-key-with-hyphens' => 1,
        'and_one_with_underscores' => 1,
        'what About_Mixed-separators!?!_and-numb333r5?' => 1,
        'one' => 1,
        'onewithsymbol!' => 1,
        '~~ ~~' => 1,
    ];

    /**
     * @test
     */
    public function it_change_nothing_for_non_associative_arrays()
    {
        $this->assertEquals(
            array_values(self::SAMPLE_ARRAY),
            array_change_key_case(array_values(self::SAMPLE_ARRAY), CASE_LISP)
        );
    }

    /**
     * @test
     */
    public function it_change_nothing_for_invalid_case_flag()
    {
        $this->assertEquals(
            array_values(self::SAMPLE_ARRAY),
            array_change_key_case(array_values(self::SAMPLE_ARRAY), 1234)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_core_upper_case()
    {
        $this->assertEquals(
            \array_change_key_case(self::SAMPLE_ARRAY, \CASE_UPPER),
            array_change_key_case(self::SAMPLE_ARRAY, \CASE_UPPER)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_core_lower_case()
    {
        $this->assertEquals(
            \array_change_key_case(self::SAMPLE_ARRAY, \CASE_LOWER),
            array_change_key_case(self::SAMPLE_ARRAY, \CASE_LOWER)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_spatie_upper_case()
    {
        $this->assertEquals(
            \array_change_key_case(self::SAMPLE_ARRAY, \CASE_UPPER),
            array_change_key_case(self::SAMPLE_ARRAY, CASE_UPPER)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_spatie_lower_case()
    {
        $this->assertEquals(
            \array_change_key_case(self::SAMPLE_ARRAY, \CASE_LOWER),
            array_change_key_case(self::SAMPLE_ARRAY, CASE_LOWER)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_snake_case()
    {
        $this->assertEquals(
            [
                'one_key_using_camel_case' => 1,
                'one_key_using_pascal_case' => 1,
                'one_key_with_spaces' => 1,
                'one_key_with_hyphens' => 1,
                'and_one_with_underscores' => 1,
                'what_about_mixed_separators!?!_and_numb_333_r_5?' => 1,
                'one' => 1,
                'onewithsymbol!' => 1,
                '~~_~~' => 1,
            ],
            array_change_key_case(self::SAMPLE_ARRAY, CASE_SNAKE)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_title_case()
    {
        $this->assertEquals(
            [
                'One key using camel case' => 1,
                'One key using pascal case' => 1,
                'One key with spaces' => 1,
                'One key with hyphens' => 1,
                'And one with underscores' => 1,
                'What about mixed separators!?! and numb 333 r 5?' => 1,
                'One' => 1,
                'Onewithsymbol!' => 1,
                '~~ ~~' => 1,
            ],
            array_change_key_case(self::SAMPLE_ARRAY, CASE_TITLE)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_camel_case()
    {
        $this->assertEquals(
            [
                'oneKeyUsingCamelCase' => 1,
                'oneKeyUsingPascalCase' => 1,
                'oneKeyWithSpaces' => 1,
                'oneKeyWithHyphens' => 1,
                'andOneWithUnderscores' => 1,
                'whatAboutMixedSeparators!?!AndNumb333r5?' => 1,
                'one' => 1,
                'onewithsymbol!' => 1,
                '~~~~' => 1,
            ],
            array_change_key_case(self::SAMPLE_ARRAY, CASE_CAMEL)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_pascal_case()
    {
        $this->assertEquals(
            [
                'OneKeyUsingCamelCase' => 1,
                'OneKeyUsingPascalCase' => 1,
                'OneKeyWithSpaces' => 1,
                'OneKeyWithHyphens' => 1,
                'AndOneWithUnderscores' => 1,
                'WhatAboutMixedSeparators!?!AndNumb333r5?' => 1,
                'One' => 1,
                'Onewithsymbol!' => 1,
                '~~~~' => 1,
            ],
            array_change_key_case(self::SAMPLE_ARRAY, CASE_PASCAL)
        );
    }

    /**
     * @test
     */
    public function it_works_with_php_lisp_case()
    {
        $this->assertEquals(
            [
                'one-key-using-camel-case' => 1,
                'one-key-using-pascal-case' => 1,
                'one-key-with-spaces' => 1,
                'one-key-with-hyphens' => 1,
                'and-one-with-underscores' => 1,
                'what-about-mixed-separators!?!-and-numb-333-r-5?' => 1,
                'one' => 1,
                'onewithsymbol!' => 1,
                '~~-~~' => 1,
            ],
            array_change_key_case(self::SAMPLE_ARRAY, CASE_LISP)
        );
    }
}

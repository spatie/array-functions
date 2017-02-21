<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 17/2/21
 * Time: 下午2:40
 */

namespace Spatie\Test;

use function spatie\array_keys_camel2snake;

class ArrayKeysCamel2SnakeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_return_camel_case(){
        $array = [
            'iAmAKey1'=>1,
            'iAmAKey2'=>2,
            'iAmAKey3'=>3,
            'iAmAKey4'=>[
                'iAmAKey41'=>41,
                'iAmAKey42'=>42,
                'iAmAKey43'=>43,
            ],
            'iAmAKey5'=>[
                'iAmAKey51'=>51,
                'iAmAKey52'=>52,
                'iAmAKey53'=>53,
                'iAmAKey54'=>[
                    'iAmAKey541'=>541,
                    'iAmAKey542'=>542,
                ],
            ],
        ];

        $arrayReturn = [
            'i_am_a_key1'=>1,
            'i_am_a_key2'=>2,
            'i_am_a_key3'=>3,
            'i_am_a_key4'=>[
                'i_am_a_key41'=>41,
                'i_am_a_key42'=>42,
                'i_am_a_key43'=>43,
            ],
            'i_am_a_key5'=>[
                'i_am_a_key51'=>51,
                'i_am_a_key52'=>52,
                'i_am_a_key53'=>53,
                'i_am_a_key54'=>[
                    'i_am_a_key541'=>541,
                    'i_am_a_key542'=>542,
                ],
            ],
        ];

        $this->assertEquals($arrayReturn, array_keys_camel2snake($array));
    }
}
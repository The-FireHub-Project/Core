<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Test
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace support\helpers;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\Enums\Order;
use FireHub\Core\Support\Exceptions\Arr\ {
    ArrayItemMissingKeyException, OutOfRangeException
};
use PHPUnit\Framework\Attributes\ {
    CoversClass, CoversFunction, Group, Small
};

use function FireHub\Core\Support\Helpers\Arr\ {
    first, last, isEmpty, crossJoin, random, shuffle, uniqueDuplicatesTwoDimensional, multiSort
};

/**
 * ### Test Data functions
 * @since 1.0.0
 */
#[Small]
#[Group('helpers')]
#[CoversClass(Order::class)]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\first')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\last')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\isEmpty')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\crossJoin')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\random')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\shuffle')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\uniqueDuplicatesTwoDimensional')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\multiSort')]
final class ArrTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIsEmpty ():void {

        $this->assertTrue(isEmpty([]));
        $this->assertFalse(isEmpty([1, 2, 3]));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFirst ():void {

        $this->assertSame(1, first([1, 2, 3]));
        $this->assertNull(first([]));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testLast ():void {

        $this->assertSame(3, last([1, 2, 3]));
        $this->assertNull(last([]));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCrossJoin ():void {

        $this->assertEquals(
            [['a', 'c'], ['a', 'd'], ['b', 'c'], ['b', 'd']],
            crossJoin(['a', 'b'], ['c', 'd'])
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRandom ():void {

        $arr = [1, 2, 3];

        $this->assertIsInt(random($arr));

        $this->assertIsArray(random($arr, 2));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAddException ():void {

        $this->expectException(OutOfRangeException::class);

        $this->assertIsArray(random([1, 2, 3], 4));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testShuffle ():void {

        $arr = ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2];

        $this->assertTrue(shuffle($arr));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testUniqueDuplicatesTwoDimensional ():void {

        $arr = [
            1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
            2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
            3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
            4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
            5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
        ];

        $this->assertSame(
            [
                'unique' => [
                    1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
                    3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25]
                ],
                'duplicates' => [
                    2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
                    4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
                    5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
                ]
            ],
            uniqueDuplicatesTwoDimensional($arr, 'lastname')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testUniqueDuplicatesTwoDimensionalException ():void {

        $this->expectException(ArrayItemMissingKeyException::class);

        $arr = [
            1 => ['id' => 1, 'firstname' => 'John', 'age' => 21],
            2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
            3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
            4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
            5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
        ];

        uniqueDuplicatesTwoDimensional($arr, 'lastname');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testMultiSort ():void {

        $arr = [
            ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'gender' => 'male', 'age' => 25],
            ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'gender' => 'female', 'age' => 23],
            ['id' => 3, 'firstname' => 'Richard', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 27],
            ['id' => 4, 'firstname' => 'Jane', 'lastname' => 'Roe', 'gender' => 'female', 'age' => 22],
            ['id' => 5, 'firstname' => 'John', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 26]
        ];

        multiSort($arr, ['lastname' => Order::ASC, 'age' => Order::DESC]);

        $this->assertSame(
            [
                ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'gender' => 'male', 'age' => 25],
                ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'gender' => 'female', 'age' => 23],
                ['id' => 3, 'firstname' => 'Richard', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 27],
                ['id' => 5, 'firstname' => 'John', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 26],
                ['id' => 4, 'firstname' => 'Jane', 'lastname' => 'Roe', 'gender' => 'female', 'age' => 22]
            ],
            $arr
        );

    }

}
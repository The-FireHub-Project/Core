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
use PHPUnit\Framework\Attributes\ {
    CoversFunction, Group, Small
};
use \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException;

use function FireHub\Core\Support\Helpers\Arr\ {
    first, last, isEmpty, crossJoin, random, shuffle
};

/**
 * ### Test Data functions
 * @since 1.0.0
 */
#[Small]
#[Group('helpers')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\first')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\last')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\isEmpty')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\crossJoin')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\random')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\shuffle')]
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

}
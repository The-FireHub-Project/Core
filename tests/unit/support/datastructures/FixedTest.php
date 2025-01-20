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

namespace support\datastructures;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\DataStructures\ {
    Fixed, Collection\Associative, Collection\Indexed
};
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Fixed data structure class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Fixed::class)]
#[CoversClass(CountBy::class)]
final class FixedTest extends Base {

    public Fixed $collection;
    public Fixed $multidimensional_collection;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Fixed(3);

        $this->collection[0] = 'one';
        $this->collection[1] = 'two';
        $this->collection[2] = 'three';

        $this->multidimensional_collection = new Fixed(4);

        $this->multidimensional_collection[0] = new Indexed([new Indexed([1,2,3]), new Indexed([1,2])]);
        $this->multidimensional_collection[1] = 'one';
        $this->multidimensional_collection[2] = 'two';
        $this->multidimensional_collection[3] = new Fixed(2);
        $this->multidimensional_collection[3][0] = new Indexed([1, 2]);
        $this->multidimensional_collection[3][1] = new Indexed([1, 2]);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(3, $this->collection->count());
        $this->assertSame(4, $this->multidimensional_collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCountBy ():void {

        $this->assertEquals(
            new Associative(['o' => 1, 't' => 2]),
            $this->collection->countBy()->funcAssoc(
                fn($value, $key) => substr((string)$value, 0, 1)
            )
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToJson ():void {

        $this->assertSame(
            '["one","two","three"]',
            $this->collection->toJSON()
        );

    }

}
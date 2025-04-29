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

namespace support\datastructures\linear;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\DataStructures\Linear\Fixed;
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

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Fixed::fromArray(['one', 'two', 'three']),
            $this->collection
        );

        $storage = new Fixed(3);
        $storage[0] = 'three';
        $storage[1] = 'one';
        $storage[2] = 'two';

        $this->assertEquals(
            Fixed::fromArray([1 => 'one', 2 => 'two', 0 => 'three'], true),
            $storage
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToArray ():void {

        $this->assertSame(['one', 'two', 'three'], $this->collection->toArray());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetSize ():void {

        $this->assertSame(3, $this->collection->getSize());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSetSize ():void {

        $this->collection->setSize(4);

        $this->assertSame(4, $this->collection->getSize());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(3, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExist ():void {

        $this->assertTrue($this->collection->exist(0));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGet ():void {

        $this->assertSame('one', $this->collection->get(0));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSet ():void {

        $collection = new Fixed(3);
        $collection[0] = 1;
        $collection[1] = 'two';
        $collection[2] = 'three';

        $this->collection->set(1, 0);

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemove ():void {

        $collection = new Fixed(3);
        $collection[0] = 'one';
        $collection[1] = 'two';

        $this->collection->remove(2);

        $this->assertEquals($collection, $this->collection);

    }

}
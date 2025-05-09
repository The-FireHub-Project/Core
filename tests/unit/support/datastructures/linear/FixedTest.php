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
use FireHub\Core\Support\DataStructures\Operation\ {
    Contains, Ensure
};
use FireHub\Core\Support\DataStructures\Function\Reduce;
use FireHub\Core\Support\DataStructures\Helpers\SequenceRange;
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
#[CoversClass(Contains::class)]
#[CoversClass(Ensure::class)]
#[CoversClass(Reduce::class)]
#[CoversClass(SequenceRange::class)]
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
    public function testCount ():void {

        $this->assertSame(3, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testContains ():void {

        $this->assertTrue($this->collection->contains()->key(0));
        $this->assertFalse($this->collection->contains()->key(3));

        $this->assertTrue($this->collection->contains()->value('one'));
        $this->assertFalse($this->collection->contains()->value('four'));

        $this->assertTrue($this->collection->contains()->where(fn($value, $key) => $value === 'one'));
        $this->assertFalse($this->collection->contains()->where(fn($value, $key) => $value === 'four'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testEnsure ():void {

        $this->assertTrue($this->collection->ensure()->all(fn($value) => is_string($value)));

        $this->assertTrue($this->collection->ensure()->none(fn($value) => is_int($value)));
        $this->assertFalse($this->collection->ensure()->none(fn($value) => is_string($value)));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testApply ():void {

        $this->assertEquals(
            Fixed::fromArray(['one.', 'two.', 'three.']),
            $this->collection->apply(fn($value) => $value.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReduce ():void {

        $this->assertSame(
            'one-two-three-',
            $this->collection->reduce(fn($carry, $value) => $carry.$value.'-')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testMerge ():void {

        $collection2 = new Fixed(2);

        $collection2[0] = 'four';
        $collection2[1] = 'five';

        $collection3 = new Fixed(5);

        $collection3[0] = 'one';
        $collection3[1] = 'two';
        $collection3[2] = 'three';
        $collection3[3] = 'four';
        $collection3[4] = 'five';

        $this->assertEquals(
            $collection3,
            $this->collection->merge($collection2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSlice ():void {

        $collection = new Fixed(2);
        $collection[0] = 'two';
        $collection[1] = 'three';

        $this->assertEquals(
            $collection,
            $this->collection->slice(1)
        );

        $collection = new Fixed(1);
        $collection[0] = 'two';

        $this->assertEquals(
            $collection,
            $this->collection->slice(1, 1)
        );

        $collection = new Fixed(2);
        $collection[0] = 'two';
        $collection[1] = 'three';

        $this->assertEquals(
            $collection,
            $this->collection->slice(-2, 3)
        );

        $collection = new Fixed(1);
        $collection[0] = 'two';

        $this->assertEquals(
            $collection,
            $this->collection->slice(1, -1)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testJsonSerialize ():void {

        $json = $this->collection->toJson();

        $this->assertSame('["one","two","three"]', $json);
        $this->assertEquals($this->collection, Fixed::fromJson($json));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSerialize ():void {

        $this->assertEquals($this->collection, Fixed::unserialize($this->collection->serialize()));

    }

}
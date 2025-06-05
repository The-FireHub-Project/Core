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
use FireHub\Core\Support\DataStructures\Linear\ {
    Fixed, Dynamic\Collection\Indexed
};
use FireHub\Core\Support\DataStructures\Operation\ {
    Contains, Ensure, Find
};
use FireHub\Core\Support\DataStructures\Function\ {
    Keys, Values
};
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Fixed data structure class
 * @since 1.0.0
 */
#[Small]
#[Group('datastructures')]
#[CoversClass(Fixed::class)]
#[CoversClass(Contains::class)]
#[CoversClass(Ensure::class)]
#[CoversClass(Find::class)]
#[CoversClass(Keys::class)]
#[CoversClass(Values::class)]
final class FixedTest extends Base {

    public Fixed $collection;

    public Fixed $collection_same_values;

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

        $this->collection_same_values = new Fixed(7);
        $this->collection_same_values[0] = 'one';
        $this->collection_same_values[1] = 'two';
        $this->collection_same_values[2] = 'two';
        $this->collection_same_values[3] = 'three';
        $this->collection_same_values[4] = 'three';
        $this->collection_same_values[5] = 'three';
        $this->collection_same_values[6] = [1,2,3];

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromDataStructure ():void {

        $collection = new Fixed(6);
        $collection[0] = 'John';
        $collection[1] = 'Jane';
        $collection[2] = 'Jane';
        $collection[3] = 'Jane';
        $collection[4] = 'Richard';
        $collection[5] = 'Richard';

        $this->assertEquals(
            $collection,
            Fixed::fromDataStructure(
                new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard'])
            )
        );

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
    public function testFind ():void {

        $this->assertEquals(1, $this->collection->find()->key('two'));
        $this->assertNull($this->collection->find()->key(3));

        $this->assertEquals('two', $this->collection->find()->first(fn($value, $key) => $key !== 0));
        $this->assertNull($this->collection->find()->first(fn($value, $key) => $key === 3));

        $this->assertEquals(1, $this->collection->find()->firstKey(fn($value, $key) => $value !== 'one'));
        $this->assertNull($this->collection->find()->firstKey(fn($value, $key) => $value === 'four'));

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
    public function testToArray ():void {

        $this->assertSame(['one', 'two', 'three'], $this->collection->toArray());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTransform ():void {

        $collection = new Fixed(3);
        $collection[0] = 'one.';
        $collection[1] = 'two.';
        $collection[2] = 'three.';

        $this->assertEquals(
            $collection,
            $this->collection->transform(fn($value) => $value.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testApply ():void {

        $collection = new Fixed(3);
        $collection[0] = 'one.';
        $collection[1] = 'two.';
        $collection[2] = 'three.';

        $this->assertEquals(
            $collection,
            $this->collection->apply(fn($value) => $value.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testKeys ():void {

        $this->assertEquals(
            new Indexed([0, 1, 2]),
            $this->collection->keys()
        );

        $this->assertEquals(
            new Indexed([0, 2]),
            $this->collection->keys(fn($value, $key) => $value !== 'two')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testValues ():void {

        $this->assertEquals(
            new Indexed(['one', 'two', 'three']),
            $this->collection->values()
        );

        $this->assertEquals(
            new Indexed(['one', 'three']),
            $this->collection->values(fn($value, $key) => $key !== 1)
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
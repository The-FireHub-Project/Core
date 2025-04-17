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
use FireHub\Core\Support\DataStructures\Linear\Fixed;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, When
};
use FireHub\Core\Support\DataStructures\Exceptions\ {
    CannotAccessOffsetException, KeyOutOfBoundsException
};
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
#[CoversClass(When::class)]
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
    public function testCountBy ():void {

        $mix = new Mix();
        $mix['o'] = 1;
        $mix['t'] = 2;

        $this->assertEquals(
            $mix,
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
    public function testWhen ():void {

        $this->assertEquals(
            Fixed::fromArray(['one', 'two', '10']),
            $this->collection->when()->is(
                true, fn(Fixed $ds) => $ds[2] = 10, fn(Fixed $ds) => $ds[2] = 11
            )
        );

        $this->assertEquals(
            Fixed::fromArray(['one', 'two', '11']),
            $this->collection->when()->is(
                false, fn(Fixed $ds) => $ds[2] = 10, fn(Fixed $ds) => $ds[2] = 11
            )
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIsEmpty ():void {

        $this->assertFalse($this->collection->isEmpty());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIsNotEmpty ():void {

        $this->assertTrue($this->collection->isNotEmpty());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExist ():void {

        $this->assertTrue($this->collection->exist(0));
        $this->assertFalse($this->collection->exist(3));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testEach ():void {

        $collection = new Fixed(3);

        $collection[0] = 'one.';
        $collection[1] = 'two.';
        $collection[2] = 'three';

        $this->assertEquals(
            $collection,
            $this->collection->each(fn($value, $key) => $this->collection[$key] = $value.'.', 2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAll ():void {

        $this->assertTrue($this->collection->all(fn($value, $key) => $key !== 3));
        $this->assertFalse($this->collection->all(fn($value, $key) => $key !== 2));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAny ():void {

        $this->assertFalse($this->collection->any(fn($value, $key) => $key === 3));
        $this->assertTrue($this->collection->any(fn($value, $key) => $key === 2));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExistException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetExists('one');

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
    public function testGetException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetGet('one');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetOutOfBoundsException ():void {

        $this->expectException(KeyOutOfBoundsException::class);

        $this->collection->offsetGet(3);
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
    public function testSetException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetSet('one', 10);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSetOutOfBoundsException ():void {

        $this->expectException(KeyOutOfBoundsException::class);

        $this->collection->offsetSet(3, 'three');

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

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemoveException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetUnset('one');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemoveOutOfBoundsException ():void {

        $this->expectException(KeyOutOfBoundsException::class);

        $this->collection->offsetUnset(3);

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
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

namespace support\datastructures\collection;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ {
    Indexed, Mix
};
use FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, When
};
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use stdClass;

/**
 * ### Test Indexed array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Indexed::class)]
#[CoversClass(CountBy::class)]
#[CoversClass(When::class)]
final class IndexedTest extends Base {

    public Indexed $collection;
    public Indexed $empty;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);

        $this->empty = Indexed::fromArray([]);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']),
            $this->collection
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToArray ():void {

        $this->assertSame(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard'], $this->collection->toArray());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(6, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCountBy ():void {

        $mix = new Mix();
        $mix['Jane'] = 3;
        $mix['John'] = 1;
        $mix['Richard'] = 2;

        $this->assertEquals($mix, $this->collection->countBy()->values());

        $mix = new Mix();
        $mix[true] = 3;
        $mix[false] = 3;

        $this->assertEquals(
            $mix,
            $this->collection->countBy()->func(
                fn($value) => $value === 'Jane'
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
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 10]),
            $this->collection->when()->is(
                true, fn(Indexed $ds) => $ds[] = 10, fn(Indexed $ds) => $ds[] = 11
            )
        );

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 10, 11]),
            $this->collection->when()->is(
                false, fn(Indexed $ds) => $ds[] = 10, fn(Indexed $ds) => $ds[] = 11
            )
        );

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 10, 11, 11]),
            $this->collection->when()->unless(
                true, fn(Indexed $ds) => $ds[] = 10, fn(Indexed $ds) => $ds[] = 11
            )
        );

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 10, 11, 11, 10]),
            $this->collection->when()->unless(
                false, fn(Indexed $ds) => $ds[] = 10, fn(Indexed $ds) => $ds[] = 11
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
        $this->assertTrue($this->empty->isEmpty());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIsNotEmpty ():void {

        $this->assertTrue($this->collection->isNotEmpty());
        $this->assertFalse($this->empty->isNotEmpty());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testShift ():void {

        $collection = Indexed::fromArray(['Jane', 'Jane', 'Jane', 'Richard', 'Richard']);

        $this->collection->shift();

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testUnshift ():void {

        $collection = Indexed::fromArray(['Johnie', 'Janie', 'Baby', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);

        $this->collection->unshift('Johnie', 'Janie', 'Baby');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPop ():void {

        $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard']);

        $this->collection->pop();

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPush ():void {

        $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']);

        $this->collection->push('Johnie', 'Janie', 'Baby');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExist ():void {

        $this->assertTrue($this->collection->offsetExists(0));
        $this->assertFalse($this->collection->offsetExists('one'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExistException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetExists(new stdClass());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGet ():void {

        $this->assertSame('John', $this->collection->offsetGet(0));
        $this->assertNull($this->collection->offsetGet('one'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetGet(new stdClass());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSet ():void {

        $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie']);

        $this->collection->offsetSet(0, 'Johnie');
        $this->collection->offsetSet(5, 'Janie');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemove ():void {

        $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard']);

        $this->collection->offsetUnset(5);

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemoveException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetUnset(new stdClass());

    }

}
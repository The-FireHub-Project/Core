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
    Obj, Mix
};
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    CannotAccessOffsetException, KeyAlreadyExistException, KeyDoesntExistException
};
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use stdClass;

/**
 * ### Test Object array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Obj::class)]
#[CoversClass(CountBy::class)]
final class ObjTest extends Base {

    public Obj $collection;
    public Obj $simple;

    public stdClass $cls1;
    public stdClass $cls2;
    public stdClass $cls3;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->cls1 = new stdClass();
        $this->cls2 = new stdClass();
        $this->cls3 = new stdClass();

        $this->collection = new Obj;
        $this->collection[$this->cls1] = 'data for object 1';
        $this->collection[$this->cls2] = [1, 2, 3];
        $this->collection[$this->cls3] = 20;

        $this->simple = new Obj;
        $this->simple[$this->cls1] = 'data for object 1';
        $this->simple[$this->cls2] = 'data for object 2';

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Obj::fromArray([
                ['key' => $this->cls1, 'data for object 1'],
                ['key' => $this->cls2, [1, 2, 3]],
                ['key' => $this->cls3, 20]
            ]),
            $this->collection
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToArray ():void {

        $this->assertSame([
            ['key' => $this->cls1, 'value' => 'data for object 1'],
            ['key' => $this->cls2, 'value' => [1, 2, 3]],
            ['key' => $this->cls3, 'value' => 20],
        ], $this->collection->toArray());

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
        $mix['d'] = 2;

        $this->assertEquals(
            $mix,
            $this->simple->countBy()->funcAssoc(
                fn($value, $key) => substr((string)$value, 0, 1)
            )
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExist ():void {

        $this->assertTrue($this->collection->exist($this->cls1));
        $this->assertFalse($this->collection->exist(new stdClass()));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExistException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetExists(10);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGet ():void {

        $this->assertEquals('data for object 1', $this->collection->get($this->cls1));
        $this->assertNull($this->collection->get(new stdClass()));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetGet(10);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSet ():void {

        $cls4 = new stdClass();

        $collection = new Obj;
        $collection[$this->cls1] = 'the data for object 1';
        $collection[$this->cls2] = [1, 2, 3];
        $collection[$this->cls3] = 20;
        $collection[$cls4] = 'the data for object 1';

        $this->collection->set('the data for object 1', $cls4);

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSetException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetSet(10, 10);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAdd ():void {

        $cls4 = new stdClass();

        $collection = new Obj;
        $collection[$this->cls1] = 'the data for object 1';
        $collection[$this->cls2] = [1, 2, 3];
        $collection[$this->cls3] = 20;
        $collection[$cls4] = 'the data for object 1';

        $this->collection->add('the data for object 1', $cls4);

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAddException ():void {

        $this->expectException(KeyAlreadyExistException::class);

        $this->collection->add(10, $this->cls1);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplace ():void {

        $collection = new Obj;
        $collection[$this->cls1] = 'the data for object 1';
        $collection[$this->cls2] = [1, 2, 3];
        $collection[$this->cls3] = 20;

        $this->collection->replace('the data for object 1', $this->cls1);

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplaceException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->collection->replace(10, new stdClass);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemove ():void {

        $collection = new Obj;
        $collection[$this->cls2] = [1, 2, 3];
        $collection[$this->cls3] = 20;

        $this->collection->remove($this->cls1);

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemoveException ():void {

        $this->expectException(CannotAccessOffsetException::class);

        $this->collection->offsetUnset(10);

    }

}
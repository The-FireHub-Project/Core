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

namespace support\datastructures\linear\dynamic\collection;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
use FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException;
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
final class ObjTest extends Base {

    public Obj $collection;

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
        $this->collection->attach($this->cls1, 'data for object 1');
        $this->collection->attach($this->cls2, [1, 2, 3]);
        $this->collection->attach($this->cls3, 20);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Obj::fromArray([
                ['key' => $this->cls1, 'value' => 'data for object 1'],
                ['key' => $this->cls2, 'value' => [1, 2, 3]],
                ['key' => $this->cls3, 'value' => 20]
            ]),
            $this->collection
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArrayMissingDataKey ():void {

        $this->expectException(StorageMissingDataException::class);

        Obj::fromArray([
            ['value' => 'data for object 1'],
            ['key' => $this->cls2, 'value' => [1, 2, 3]],
            ['key' => $this->cls3, 'value' => 20]
        ]);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArrayMissingDataValue ():void {

        $this->expectException(StorageMissingDataException::class);

        Obj::fromArray([
            ['key' => $this->cls1],
            ['key' => $this->cls2, 'value' => [1, 2, 3]],
            ['key' => $this->cls3, 'value' => 20]
        ]);

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
    public function testHas ():void {

        $this->assertTrue($this->collection->has($this->cls1));
        $this->assertFalse($this->collection->has(new stdClass()));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAttach ():void {

        $collection = new Obj;
        $collection->attach($this->cls1, 'data for object 1');
        $collection->attach($this->cls2, [1, 2, 3]);
        $collection->attach($this->cls3, 20);

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testDetach ():void {

        $collection = new Obj;
        $collection->attach($this->cls2, [1, 2, 3]);
        $collection->attach($this->cls3, 20);

        $this->collection->detach($this->cls1);

        $this->assertEquals($collection, $this->collection);

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

}
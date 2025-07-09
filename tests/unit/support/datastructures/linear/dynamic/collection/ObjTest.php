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
use FireHub\Core\Support\DataStructures\Operation\Take;
use FireHub\Core\Support\DataStructures\Function\ {
    Slice, Splice
};
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyDoesntExistException, StorageMissingDataException
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
#[Group('datastructures')]
#[CoversClass(Obj::class)]
#[CoversClass(Take::class)]
#[CoversClass(Slice::class)]
#[CoversClass(Splice::class)]
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
    public function testInfo ():void {

        $this->assertSame('data for object 1', $this->collection->info($this->cls1));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testInfoException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->collection->info(new stdClass());

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

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTransform ():void {

        $this->assertEquals(
            [
                ['key' => $this->cls1, 'value' => 'data for object 1'],
                ['key' => $this->cls2, 'value' => [1, 2, 3]],
                ['key' => $this->cls3, 'value' => 21]
            ],
            $this->collection->transform(fn($info, $object) => $object !== $this->cls3 ? $info : $info + 1)->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testApply ():void {

        $this->assertEquals(
            [
                ['key' => $this->cls1, 'value' => 'data for object 1'],
                ['key' => $this->cls2, 'value' => [1, 2, 3]],
                ['key' => $this->cls3, 'value' => 21]
            ],
            $this->collection->apply(fn($info, $object) => $object !== $this->cls3 ? $info : $info + 1)->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFilter ():void {

        $collection = new Obj;
        $collection->attach($this->cls1, 'data for object 1');
        $collection->attach($this->cls3, 20);

        $this->assertEquals(
            $collection,
            $this->collection->filter(fn($info, $object) => $object !== $this->cls2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSlice ():void {

        $collection = new Obj();
        $collection->attach($this->cls2, [1, 2, 3]);
        $collection->attach($this->cls3, 20);

        $this->assertEquals(
            $collection,
            new Slice($this->collection)(1, 2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSplice ():void {

        $collection = new Obj();
        $collection->attach($this->cls1, 'data for object 1');
        $collection->attach($this->cls3, 20);

        $this->assertEquals(
            $collection,
            new Splice($this->collection)(1, 1)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTakeOperation ():void {

        $collection = new Obj();
        $collection->attach($this->cls1, 'data for object 1');
        $collection->attach($this->cls2, [1, 2, 3]);
        $this->assertEquals(
            $collection,
            new Take($this->collection)->first(2)
        );

        $collection = new Obj();
        $collection->attach($this->cls2, [1, 2, 3]);
        $collection->attach($this->cls3, 20);
        $this->assertEquals(
            $collection,
            new Take($this->collection)->last(2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testChunkWhere ():void {

        $collection = new Obj();
        $collection->attach($this->cls1, 'data for object 1');
        $collection->attach($this->cls2, [1, 2, 3]);

        $collection2 = new Obj();
        $collection2->attach($this->cls3, 20);

        $this->assertEquals([
            ['key' => 0, 'value' => $collection],
            ['key' => 1, 'value' => $collection2]
        ],
            $this->collection->chunkWhere(fn($info, $object) => $info === [1, 2, 3])->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testUnion ():void {

        $cls4 = new stdClass;

        $collection = new Obj;
        $collection->attach($this->cls1, 'new data for object 2');
        $collection->attach($this->cls2, [1, 2, 3, 4]);
        $collection->attach($this->cls3, 21);
        $collection->attach($cls4, 31);

        $result = new Obj;
        $result->attach($this->cls1, 'new data for object 2');
        $result->attach($this->cls2, [1, 2, 3, 4]);
        $result->attach($this->cls3, 21);
        $result->attach($cls4, 31);

        $this->assertEquals(
            $result,
            $this->collection->union($collection)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testJsonSerialize ():void {

        $json = $this->collection->toJson();

        $this->assertSame('[{"key":{},"value":"data for object 1"},{"key":{},"value":[1,2,3]},{"key":{},"value":20}]', $json);

    }

}
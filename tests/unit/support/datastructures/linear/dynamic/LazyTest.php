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

namespace support\datastructures\linear\dynamic;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Lazy data structure class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Lazy::class)]
final class LazyTest extends Base {

    public Lazy $collection;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Lazy(
            fn() => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Lazy::fromArray([
                ['key' => 'firstname', 'value' => 'John'],
                ['key' => 'lastname', 'value' => 'Doe'],
                ['key' => 'age', 'value' => 25],
                ['key' => 10, 'value' => 2]
            ])->toArray(),
            $this->collection->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArrayMissingDataKey ():void {

        $this->expectException(StorageMissingDataException::class);

        Lazy::fromArray([
            ['value' => 'John'],
            ['key' => 'lastname', 'value' => 'Doe'],
            ['key' => 'age', 'value' => 25],
            ['key' => 10, 'value' => 2]
        ])->toArray();

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArrayMissingDataValue ():void {

        $this->expectException(StorageMissingDataException::class);

        Lazy::fromArray([
            ['key' => 'firstname'],
            ['key' => 'lastname', 'value' => 'Doe'],
            ['key' => 'age', 'value' => 25],
            ['key' => 10, 'value' => 2]
        ])->toArray();

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(4, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToArray ():void {

        $this->assertSame([
            ['key' => 'firstname', 'value' => 'John'],
            ['key' => 'lastname', 'value' => 'Doe'],
            ['key' => 'age', 'value' => 25],
            ['key' => 10, 'value' => 2]
        ], $this->collection->toArray());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTransform ():void {

        $this->assertSame(
            [
                ['key' => 'firstname', 'value' => 'John.'],
                ['key' => 'lastname', 'value' => 'Doe.'],
                ['key' => 'age', 'value' => '25.'],
                ['key' => 10, 'value' => '2.']
            ],
            $this->collection->transform(fn($value) => $value.'.')->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testApply ():void {

        $this->assertSame(
            [
                ['key' => 'firstname', 'value' => 'John.'],
                ['key' => 'lastname', 'value' => 'Doe.'],
                ['key' => 'age', 'value' => '25.'],
                ['key' => 10, 'value' => '2.']
            ],
            $this->collection->apply(fn($value) => $value.'.')->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testJsonSerialize ():void {

        $json = $this->collection->toJson();

        $this->assertSame('[{"key":"firstname","value":"John"},{"key":"lastname","value":"Doe"},{"key":"age","value":25},{"key":10,"value":2}]', $json);
        $this->assertEquals($this->collection, Lazy::fromJson($json));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSerialize ():void {

        $this->assertEquals($this->collection, Lazy::unserialize($this->collection->serialize()));

    }

}
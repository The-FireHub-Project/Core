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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyAlreadyExistException, KeyDoesntExistException
};
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use stdClass;

/**
 * ### Test Mixed collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Mix::class)]
#[CoversClass(CountBy::class)]
final class MixTest extends Base {

    public Mix $collection;
    public Mix $simple;

    public stdClass $cls1;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->cls1 = new stdClass();

        $this->collection = new Mix();
        $this->collection['one'] = 1;
        $this->collection[$this->cls1] = 'two';

        $this->simple = new Mix();
        $this->simple['one'] = 1;
        $this->simple['two'] = 2;

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Mix::fromArray([
                'one' => ['key' => 'one', 'value' => 1],
                'two' => ['key' => 'two', 'value' => 2]
            ]),
            $this->simple
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToArray ():void {

        $this->assertSame([
            'one' => ['key' => 'one', 'value' => 1],
            'two' => ['key' => 'two', 'value' => 2]
        ], $this->simple->toArray());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(2, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCountBy ():void {

        $mix = new Mix();
        $mix[1] = 1;
        $mix['t'] = 1;

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

        $this->assertTrue($this->collection->exist('one'));
        $this->assertFalse($this->collection->exist('two'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGet ():void {

        $this->assertSame(1, $this->collection->get('one'));
        $this->assertNull($this->collection->get('two'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSet ():void {

        $collection = new Mix();
        $collection['one'] = 2;
        $collection['three'] = 3;
        $collection[$this->cls1] = 'two';

        $this->collection->set(2, 'one');
        $this->collection->set(3, 'three');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAdd ():void {

        $collection = new Mix();
        $collection['one'] = 1;
        $collection[$this->cls1] = 'two';
        $collection['three'] = 3;

        $this->collection->add(3, 'three');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAddException ():void {

        $this->expectException(KeyAlreadyExistException::class);

        $this->collection->add(2, 'one');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplace ():void {

        $collection = new Mix();
        $collection['one'] = 2;
        $collection[$this->cls1] = 'two';

        $this->collection->replace(2, 'one');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplaceException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->collection->replace(2, 'three');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemove ():void {

        $collection = new Mix();
        $collection[$this->cls1] = 'two';

        $this->collection->remove('one');

        $this->assertEquals($collection, $this->collection);

    }

}
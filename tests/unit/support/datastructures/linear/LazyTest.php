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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, When
};
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use Generator;

/**
 * ### Test Lazy data structure class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Lazy::class)]
#[CoversClass(CountBy::class)]
#[CoversClass(When::class)]
final class LazyTest extends Base {

    public Lazy $collection;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Lazy(
            fn():Generator => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Lazy::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]),
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
    public function testCount ():void {

        $this->assertSame(4, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCountBy ():void {

        $mix = new Mix();
        $mix['J'] = 1;
        $mix['D'] = 1;
        $mix[2] = 2;

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
            Lazy::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'male']),
            $this->collection->when()->is(
                true, fn(Lazy $ds) => yield 'gender' => 'male', fn(Lazy $ds) => yield 'gender' => 'female'
            )
        );

        $this->assertEquals(
            Lazy::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']),
            $this->collection->when()->is(
                false, fn(Lazy $ds) => yield 'gender' => 'male', fn(Lazy $ds) => yield 'gender' => 'female'
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
    public function testAll ():void {

        $this->assertTrue($this->collection->all(fn($value, $key) => $key !== 'gender'));
        $this->assertFalse($this->collection->all(fn($value, $key) => $key !== 'lastname'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAny ():void {

        $this->assertFalse($this->collection->any(fn($value, $key) => $key === 'gender'));
        $this->assertTrue($this->collection->any(fn($value, $key) => $key === 'lastname'));

    }

}
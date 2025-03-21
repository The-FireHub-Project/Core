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
use FireHub\Core\Support\DataStructures\ {
    Lazy, Collection\Associative, Collection\Indexed
};
use FireHub\Core\Support\DataStructures\Operation\CountBy;
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
final class LazyTest extends Base {

    public Lazy $collection;
    public Lazy $empty;
    public Lazy $multidimensional_collection;
    public Lazy $simple;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Lazy(
            fn():Generator => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]
        );

        $this->empty = new Lazy(
            fn():Generator => yield from []
        );

        $this->multidimensional_collection = new Lazy(function ():Generator {
            yield from [
                new Indexed([new Indexed([1,2,3]), new Indexed([1,2])]),
                'one',
                'two',
                new Indexed([new Indexed([1,2]),new Indexed([1,2])])
            ];
        });

        $this->simple = new Lazy(
            fn():Generator => yield from ['one', 'two']
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(4, $this->collection->count());
        $this->assertSame(4, $this->multidimensional_collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCountBy ():void {

        $this->assertEquals(
            new Associative(['J' => 1, 'D' => 1, 2 => 2]),
            $this->collection->countBy()->funcAssoc(
                fn($value, $key) => substr((string)$value, 0, 1)
            )
        );

    }

}
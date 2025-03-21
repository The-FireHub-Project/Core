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
use FireHub\Core\Support\DataStructures\Collection\Associative;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Associative array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Associative::class)]
#[CoversClass(CountBy::class)]
final class AssociativeTest extends Base {

    public Associative $collection;
    public Associative $numbers;
    public Associative $empty;
    public Associative $two_dimensional;
    public Associative $multidimensional;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Associative(
            ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]
        );

        $this->numbers = new Associative([1, 2, 3, 4, 13, 22, 27, 28, 29]);

        $this->empty = new Associative([]);

        $this->two_dimensional = new Associative([
            'first' => ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2],
            'second' => ['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 21, 10 => 1],
            'third' => ['firstname' => 'Richard', 'lastname' => 'Roe', 'age' => 27]
        ]);

        $this->multidimensional = new Associative([
            'first' => ['name' => ['firstname' => 'John', 'lastname' => 'Doe'], 'age' => 25, 10 => 2],
            'second' => ['name' => ['firstname' => 'Jane', 'lastname' => 'Doe'], 'age' => 21, 10 => 1],
            'third' => ['name' => ['firstname' => 'Richard', 'lastname' => 'Roe'], 'age' => 27]
        ]);

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

        $this->assertEquals(
            new Associative(['J' => 1, 'D' => 1, 2 => 2]),
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
    public function testFirst ():void {

        $this->assertSame('John', $this->collection->first());

        $this->assertSame('Doe', $this->collection->first(function ($value, $key) {
            return $key !== 'firstname';
        }));

        $this->assertNull($this->collection->first(function ($value) {
            return $value === 'Jack';
        }));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testLast ():void {

        $this->assertSame(2, $this->collection->last());

        $this->assertSame(25, $this->collection->last(function ($value, $key) {
            return $key !== 10;
        }));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToJson ():void {

        $this->assertSame(
            '{"firstname":"John","lastname":"Doe","age":25,"10":2}',
            $this->collection->toJSON()
        );

    }

}
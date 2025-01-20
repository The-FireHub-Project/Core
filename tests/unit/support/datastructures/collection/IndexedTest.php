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
use FireHub\Core\Support\DataStructures\Collection\ {
    Indexed, Associative
};
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Indexed array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Indexed::class)]
#[CoversClass(CountBy::class)]
final class IndexedTest extends Base {

    public Indexed $collection;
    public Indexed $multidimensional;
    public Indexed $multidimensional_collection;
    public Indexed $multidimensional_numbers;
    public Indexed $numbers;
    public Indexed $empty;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);

        $this->multidimensional = new Indexed([
            ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2],
            ['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 21, 10 => 1],
            ['firstname' => 'Richard', 'lastname' => 'Roe', 'age' => 27]
        ]);

        $this->multidimensional_numbers = new Indexed ([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ]);

        $this->multidimensional_collection = new Indexed([
            new Indexed([new Indexed([1,2,3]), new Indexed([1,2])]),
            'one',
            'two',
            new Indexed([new Indexed([1,2]),new Indexed([1,2])])
        ]);

        $this->numbers = new Indexed([1, 2, 3, 4, 13, 22, 27, 28, 29]);

        $this->empty = new Indexed([]);

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

        $this->assertEquals(
            new Associative(['Jane' => 3, 'John' => 1, 'Richard' => 2]),
            $this->collection->countBy()->values()
        );

        $this->assertEquals(
            new Associative([1 => 3, 0 => 3]),
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
    public function testToJson ():void {

        $this->assertSame(
            '["John","Jane","Jane","Jane","Richard","Richard"]',
            $this->collection->toJSON()
        );

    }

}
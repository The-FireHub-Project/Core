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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use stdClass;

/**
 * ### Test Indexed array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('datastructures')]
#[CoversClass(Indexed::class)]
final class IndexedTest extends Base {

    public Indexed $collection;
    public Indexed $empty;
    public Indexed $mix;
    public Indexed $numbers;

    public stdClass $cls1;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->cls1 = new stdClass();

        $this->collection = new Indexed(
            ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']
        );

        $this->empty = new Indexed();

        $this->mix = new Indexed([$this->cls1, 0, 1, 'one', false, true, null]);

        $this->numbers = new Indexed([1, 2, 3, 4, 13, 22, 27, 28, 29]);

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
    public function testCount ():void {

        $this->assertSame(6, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testShift ():void {

        $collection = new Indexed(['Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
        $this->collection->shift();
        $this->assertEquals($collection, $this->collection);

        $collection = new Indexed(['Johnie', 'Janie', 'Baby', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
        $collection2 = new Indexed(['Jane', 'Richard', 'Richard']);
        $collection->shift(6);
        $this->assertEquals($collection, $collection2);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPop ():void {

        $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard']);
        $this->collection->pop();
        $this->assertEquals($collection, $this->collection);

        $collection = new Indexed(['Johnie', 'Janie', 'Baby', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
        $collection2 = new Indexed(['Johnie', 'Janie', 'Baby']);
        $collection->pop(6);
        $this->assertEquals($collection, $collection2);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPrepend ():void {

        $collection = new Indexed(['Johnie', 'Janie', 'Baby', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);

        $this->collection->prepend('Johnie', 'Janie', 'Baby');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAppend ():void {

        $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']);

        $this->collection->append('Johnie', 'Janie', 'Baby');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testHead ():void {

        $this->assertSame('John', $this->collection->head());

        $this->assertNull($this->empty->head());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTail ():void {

        $this->assertSame('Richard', $this->collection->tail());

        $this->assertNull($this->empty->tail());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToArray ():void {

        $this->assertSame(
            ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard'],
            $this->collection->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testJsonSerialize ():void {

        $json = $this->collection->toJson();

        $this->assertSame('["John","Jane","Jane","Jane","Richard","Richard"]', $json);
        $this->assertEquals($this->collection, Indexed::fromJson($json));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSerialize ():void {

        $this->assertEquals($this->collection, Indexed::unserialize($this->collection->serialize()));

    }

}
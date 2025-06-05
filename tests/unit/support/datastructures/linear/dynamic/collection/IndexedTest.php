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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ {
    Indexed, Associative, Obj
};
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, Ensure, Is
};
use FireHub\Core\Support\DataStructures\Function\ {
    Combine, Reduce
};
use FireHub\Core\Support\Enums\Data\Type;
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
#[CoversClass(CountBy::class)]
#[CoversClass(Ensure::class)]
#[CoversClass(Is::class)]
#[CoversClass(Combine::class)]
#[CoversClass(Reduce::class)]
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
    public function testFromDataStructure ():void {

        $this->assertEquals(
            new Indexed(['John', 'Doe', 25, 2]),
            Indexed::fromDataStructure(
                new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2])
            )
        );

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
    public function testCountBy ():void {

        $this->assertSame(3, $this->collection->countBy()->value('Jane'));

        $collection = new Associative();
        $collection->set(3, 'Jane');
        $collection->set(1, 'John');
        $collection->set(2, 'Richard');
        $this->assertEquals($collection, $this->collection->countBy()->values());

        $this->assertSame(1, $this->mix->countBy()->type(Type::T_STRING));

        $collection = new Obj();
        $collection->attach(Type::T_BOOL, 2);
        $collection->attach(Type::T_INT, 2);
        $collection->attach(Type::T_STRING, 1);
        $collection->attach(Type::T_NULL, 1);
        $collection->attach(Type::T_OBJECT, 1);
        $this->assertEquals($collection, $this->mix->countBy()->types());

        $this->assertEquals(
            new Associative(['J' => 4, 'R' => 2]),
            $this->collection->countBy()->where(fn($value, $key) => substr((string)$value, 0, 1))
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testEnsure ():void {

        $this->assertTrue($this->collection->ensure()->all(fn($value) => is_string($value)));

        $this->assertFalse($this->collection->ensure()->none(fn($value) => is_string($value)));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIs ():void {

        $this->assertFalse($this->collection->is()->empty());
        $this->assertTrue($this->collection->is()->notEmpty());

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
    public function testRandom ():void {

        $this->assertIsString($this->collection->random());

        $this->assertInstanceOf(Indexed::class, $this->collection->random(2));

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
    public function testTransform ():void {

        $this->assertEquals(
            new Indexed(['John.', 'Jane.', 'Jane.', 'Jane.', 'Richard.', 'Richard.']),
            $this->collection->transform(fn($value) => $value.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testApply ():void {

        $this->assertEquals(
            new Indexed(['John.', 'Jane.', 'Jane.', 'Jane.', 'Richard.', 'Richard.']),
            $this->collection->apply(fn($value) => $value.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testWhenTrue ():void {

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie']),
            $this->collection->when(
                true,
                fn(Indexed $collection) => $collection->append('Johnie'),
                fn(Indexed $collection) => $collection->append('Janie')
            )
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testWhenFalse ():void {

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Janie']),
            $this->collection->when(
                false,
                fn(Indexed $collection) => $collection->append('Johnie'),
                fn(Indexed $collection) => $collection->append('Janie')
            )
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testUnlessTrue ():void {

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Janie']),
            $this->collection->unless(
                true,
                fn(Indexed $collection) => $collection->append('Johnie'),
                fn(Indexed $collection) => $collection->append('Janie')
            )
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testUnlessFalse ():void {

        $this->assertEquals(
            Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie']),
            $this->collection->unless(
                false,
                fn(Indexed $collection) => $collection->append('Johnie'),
                fn(Indexed $collection) => $collection->append('Janie')
            )
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCombine ():void {

        $this->assertEquals(
            new Associative(['John' => 'one', 'Jane' => 'two', 'Richard' => 'three']),
            new Indexed(['John', 'Jane', 'Richard'])->combine(new Indexed(['one', 'two', 'three']))
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function reduceTest ():void {

        $this->assertSame(
            'John-Jane-Jane-Jane-Richard-Richard-',
            new Reduce($this->collection)(fn($carry, $value) => $carry.$value.'-')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReverse ():void {

        $this->assertEquals(
            new Indexed(['Richard', 'Richard','Jane', 'Jane', 'Jane', 'John']),
            $this->collection->reverse()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testShuffle ():void {

        $this->assertIsArray($this->collection->shuffle()->toArray());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPad ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Daniel', 'Daniel', 'Daniel', 'Daniel']),
            $this->collection->pad(10, 'Daniel')
        );

        $this->assertEquals(
            new Indexed([ 'Daniel', 'Daniel', 'Daniel', 'Daniel', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']),
            $this->collection->pad(-10, 'Daniel')
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
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
    CountBy, Ensure, Is, Skip, Take
};
use FireHub\Core\Support\DataStructures\Function\ {
    Chunk, Combine, Reduce, Reject, Partition, Slice, Splice, Split
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
#[CoversClass(Skip::class)]
#[CoversClass(Take::class)]
#[CoversClass(Is::class)]
#[CoversClass(Chunk::class)]
#[CoversClass(Combine::class)]
#[CoversClass(Reduce::class)]
#[CoversClass(Reject::class)]
#[CoversClass(Partition::class)]
#[CoversClass(Slice::class)]
#[CoversClass(Splice::class)]
#[CoversClass(Split::class)]
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
    public function testFilter ():void {

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane']),
            $this->collection->filter(fn($value) => $value === 'Jane')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReject ():void {

        $this->assertEquals(
            new Indexed(['John', 'Richard', 'Richard']),
            new Reject($this->collection)(fn($value) => $value === 'Jane')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSlice ():void {

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Richard', 'Richard']),
            new Slice($this->collection)(2)
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane', 'Richard']),
            new Slice($this->collection)(1, 4)
        );

        $this->assertEquals(
            new Indexed(['Richard', 'Richard']),
            new Slice($this->collection)(-2, 3)
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane', 'Richard']),
            new Slice($this->collection)(1, -1)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSplice ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Richard']),
            new Splice($this->collection)(2, 3)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTakeOperation ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane']),
            new Take($this->collection)->first(2)
        );

        $this->assertEquals(
            new Indexed(['Richard', 'Richard']),
            new Take($this->collection)->last(2)
        );

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane']),
            new Take($this->collection)->until(fn($value) => $value === 'Richard')
        );

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane']),
            new Take($this->collection)->while(fn($value) => $value !== 'Richard')
        );

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Richard']),
            new Take($this->collection)->nth(2)
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Richard']),
            new Take($this->collection)->even()
        );

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Richard']),
            new Take($this->collection)->odd()
        );

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Richard']),
            new Take($this->collection)->distinct()
        );

        $this->assertEquals(
            new Indexed(['John']),
            new Take($this->collection)->unique()
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane', 'Richard', 'Richard']),
            new Take($this->collection)->duplicates()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSkip ():void {

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Richard', 'Richard']),
            new Skip($this->collection)->first(2)
        );

        $this->assertEquals(
            new Indexed(['Richard', 'Richard']),
            new Skip($this->collection)->until(fn($value) => $value === 'Richard')
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane', 'Richard', 'Richard']),
            new Skip($this->collection)->while(fn($value) => $value === 'John')
        );

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Richard']),
            new Skip($this->collection)->nth(3)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPartition ():void {

        $this->assertEquals([
            ['key' => 0, 'value' => new Indexed(['Richard', 'Richard'])],
            ['key' => 1, 'value' => new Indexed(['John', 'Jane', 'Jane', 'Jane'])]
        ],
            new Partition($this->collection)(fn($value) => $value === 'Richard')->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testChunkWhere ():void {

        $this->assertEquals([
            ['key' => 0, 'value' => new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard'])],
            ['key' => 1, 'value' => new Indexed(['Richard'])]
        ],
            $this->collection->chunkWhere(fn($value, $key) => $value === 'Richard')->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testChunk ():void {

        $this->assertEquals([
            ['key' => 0, 'value' => new Indexed(['John', 'Jane', 'Jane', 'Jane'])],
            ['key' => 1, 'value' => new Indexed(['Richard', 'Richard'])]
        ],
            new Chunk($this->collection)(4)->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSplit ():void {

        $this->assertEquals([
            ['key' => 0, 'value' => new Indexed(['John', 'Jane'])],
            ['key' => 1, 'value' => new Indexed(['Jane', 'Jane'])],
            ['key' => 2, 'value' => new Indexed(['Richard'])],
            ['key' => 3, 'value' => new Indexed(['Richard'])]
        ],
            new Split($this->collection)(4)->toArray()
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
    public function testJoin ():void {

        $collection = new Indexed(['Johnie', 'Janie', 'Baby']);

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']),
            $this->collection->join($collection)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCrossJoin ():void {

        $collection = new Indexed(['c', 'd']);

        $this->assertEquals(
            new Indexed([
                ['a', 'c'], ['a', 'd'], ['b', 'c'], ['b', 'd']
            ]),
            new Indexed(['a', 'b'])->crossJoin($collection)
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
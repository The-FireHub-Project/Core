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
    CountBy, Ensure
};
use FireHub\Core\Support\DataStructures\Function\Reduce;
use FireHub\Core\Support\DataStructures\Helpers\SequenceRange;
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
#[Group('collection')]
#[CoversClass(Indexed::class)]
#[CoversClass(CountBy::class)]
#[CoversClass(Ensure::class)]
#[CoversClass(Reduce::class)]
#[CoversClass(SequenceRange::class)]
final class IndexedTest extends Base {

    public Indexed $collection;
    public Indexed $empty;
    public Indexed $mix;

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

        $this->empty = new Indexed([]);

        $this->mix = new Indexed([$this->cls1, 0, 1, 'one', false, true, null]);

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
    public function testCount ():void {

        $this->assertSame(6, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCountBy ():void {

        $this->assertEquals(6, $this->collection->countBy()->elements());

        $collection = new Associative();
        $collection['Jane'] = 3;
        $collection['John'] = 1;
        $collection['Richard'] = 2;

        $this->assertEquals($collection, $this->collection->countBy()->values());

        $collection = new Associative();
        $collection[true] = 3;
        $collection[false] = 3;

        $collection = new Obj();
        $collection->attach(Type::T_BOOL, 2);
        $collection->attach(Type::T_INT, 2);
        $collection->attach(Type::T_STRING, 1);
        $collection->attach(Type::T_NULL, 1);
        $collection->attach(Type::T_OBJECT, 1);

        $this->assertEquals($collection, $this->mix->countBy()->type());

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
    public function testApply ():void {

        $this->assertEquals(
            Indexed::fromArray(['John.', 'Jane.', 'Jane.', 'Jane.', 'Richard.', 'Richard.']),
            $this->collection->apply(fn($value) => $value.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReduce ():void {

        $this->assertSame(
            'John-Jane-Jane-Jane-Richard-Richard-',
            $this->collection->reduce(fn($carry, $value) => $carry.$value.'-')
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
    public function testMerge ():void {

        $collection = new Indexed(['Johnie', 'Janie', 'Baby']);

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']),
            $this->collection->merge($collection)
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
            $this->collection->slice(2)
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane', 'Richard']),
            $this->collection->slice(1, 4)
        );

        $this->assertEquals(
            new Indexed(['Richard', 'Richard']),
            $this->collection->slice(-2, 3)
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane', 'Richard']),
            $this->collection->slice(1, -1)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTake ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane']),
            $this->collection->take(2)
        );

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane']),
            $this->collection->take(-2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTakeUntil ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane']),
            $this->collection->takeUntil(fn($value) => $value === 'Richard')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTakeWhile ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Jane', 'Jane']),
            $this->collection->takeWhile(fn($value) => $value !== 'Richard')
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
            $this->collection->skip(2)
        );

        $this->assertEquals(
            new Indexed(['Richard', 'Richard']),
            $this->collection->skip(-2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSkipUntil ():void {

        $this->assertEquals(
            new Indexed(['Richard', 'Richard']),
            $this->collection->skipUntil(fn($value) => $value === 'Richard')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSkipWhile ():void {

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Jane', 'Richard', 'Richard']),
            $this->collection->skipWhile(fn($value) => $value === 'John')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testNth ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Richard']),
            $this->collection->nth(2)
        );

        $this->assertEquals(
            new Indexed(['Jane', 'Jane']),
            $this->collection->nth(2, 1, 4)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testEven ():void {

        $this->assertEquals(
            new Indexed(['Jane', 'Jane', 'Richard']),
            $this->collection->even()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testOdd ():void {

        $this->assertEquals(
            new Indexed(['John', 'Jane', 'Richard']),
            $this->collection->odd()
        );

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
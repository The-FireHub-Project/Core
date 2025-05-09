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
    Associative, Indexed
};
use FireHub\Core\Support\DataStructures\Operation\ {
    Contains, Find, Is
};
use FireHub\Core\Support\DataStructures\Helpers\SequenceRange;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyAlreadyExistException, KeyDoesntExistException
};
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
#[CoversClass(Contains::class)]
#[CoversClass(Find::class)]
#[CoversClass(Is::class)]
#[CoversClass(SequenceRange::class)]
final class AssociativeTest extends Base {

    public Associative $collection;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Associative(
            ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]),
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
            ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2],
            $this->collection->toArray()
        );

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
    public function testContains ():void {

        $this->assertTrue($this->collection->contains()->key('firstname'));
        $this->assertFalse($this->collection->contains()->key('middlename'));

        $this->assertTrue($this->collection->contains()->value('John'));
        $this->assertFalse($this->collection->contains()->value('Richard'));

        $this->assertTrue($this->collection->contains()->where(fn($value, $key) => $value === 'John'));
        $this->assertFalse($this->collection->contains()->where(fn($value, $key) => $value === 'Richard'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFind ():void {

        $this->assertEquals('lastname', $this->collection->find()->key('Doe'));
        $this->assertNull($this->collection->find()->key('Jane'));

        $this->assertEquals('Doe', $this->collection->find()->value('lastname'));
        $this->assertNull($this->collection->find()->value('middlename'));

        $this->assertEquals('Doe', $this->collection->find()->first(fn($value, $key) => $key !== 'firstname'));
        $this->assertNull($this->collection->find()->first(fn($value, $key) => $key === 'Jane'));

        $this->assertEquals('lastname', $this->collection->find()->firstKey(fn($value, $key) => $value !== 'John'));
        $this->assertNull($this->collection->find()->firstKey(fn($value, $key) => $value === 'middlename'));

        $this->assertEquals(25, $this->collection->find()->last(fn($value, $key) => $key !== 10));
        $this->assertNull($this->collection->find()->last(fn($value, $key) => $key === 'Jane'));

        $this->assertEquals('age', $this->collection->find()->lastKey(fn($value, $key) => $value !== 2));
        $this->assertNull($this->collection->find()->lastKey(fn($value, $key) => $value === 'middlename'));

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
    public function testEach ():void {

        $this->assertEquals(
            Associative::fromArray(['firstname' => 'John.', 'lastname' => 'Doe.', 'age' => 25, 10 => 2]),
            $this->collection->each(fn($value, $key) => $this->collection[$key] = $value.'.', 2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testApply ():void {

        $this->assertEquals(
            Associative::fromArray(['firstname' => 'John.', 'lastname' => 'Doe.', 'age' => '25.', 10 => '2.']),
            $this->collection->apply(fn($value) => $value.'.')
        );

        $this->assertEquals(
            Associative::fromArray(['firstname' => 'John.', 'lastname' => 'Doe', 'age' => 25, 10 => 2]),
            $this->collection->apply(fn($value, $key) => $key !== 'John' ?: $value.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testApplyToKeys ():void {

        $this->assertEquals(
            Associative::fromArray(['firstname.' => 'John', 'lastname.' => 'Doe', 'age.' => 25, '10.' => 2]),
            $this->collection->applyToKeys(fn($value, $key) => $key.'.')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testKeys ():void {

        $this->assertEquals(
            Indexed::fromArray(['firstname', 'lastname', 'age', 10]),
            $this->collection->keys()
        );

        $this->assertEquals(
            Indexed::fromArray(['firstname']),
            $this->collection->keys('John')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testValues ():void {

        $this->assertEquals(
            Indexed::fromArray(['John', 'Doe', 25, 2]),
            $this->collection->values()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testMerge ():void {

        $collection = new Associative(['firstname' => 'Jane', 'middlename' => 'Marry']);

        $this->assertEquals(
            new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'middlename' => 'Marry']),
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
            new Associative(['lastname' => 'Doe', 'age' => 25]),
            $this->collection->slice(1, 2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testNth ():void {

        $this->assertEquals(
            new Associative(['firstname' => 'John', 'age' => 25]),
            $this->collection->nth(2)
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExist ():void {

        $this->assertTrue($this->collection->exist('firstname'));
        $this->assertFalse($this->collection->exist('gander'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGet ():void {

        $this->assertSame('John', $this->collection->get('firstname'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->collection->get('gender');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSet ():void {

        $collection = new Associative(['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']);

        $this->collection->set('Jane', 'firstname');
        $this->collection->set('female', 'gender');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAdd ():void {

        $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']);

        $this->collection->add('female', 'gender');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAddException ():void {

        $this->expectException(KeyAlreadyExistException::class);

        $this->collection->add('Jane', 'firstname');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplace ():void {

        $collection = new Associative(['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);

        $this->collection->replace('Jane', 'firstname');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplaceException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->collection->replace('male', 'gender');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemove ():void {

        $collection = new Associative(['lastname' => 'Doe', 'age' => 25, 10 => 2]);

        $this->collection->remove('firstname');

        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemoveException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->collection->remove('middlename');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testOverload ():void {

        $collection = new Associative(
            ['lastname' => 'Doe', 'age' => 25, 10 => 2, 'middlename' => 'Marry']
        );

        $this->collection->middlename = 'Marry';
        unset($this->collection->firstname);

        $this->assertTrue(isset($this->collection->lastname));
        $this->assertSame(25, $this->collection->age);
        $this->assertEquals($collection, $this->collection);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testJsonSerialize ():void {

        $json = $this->collection->toJson();

        $this->assertSame('{"firstname":"John","lastname":"Doe","age":25,"10":2}', $json);
        $this->assertEquals($this->collection, Associative::fromJson($json));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSerialize ():void {

        $this->assertEquals($this->collection, Associative::unserialize($this->collection->serialize()));

    }

}
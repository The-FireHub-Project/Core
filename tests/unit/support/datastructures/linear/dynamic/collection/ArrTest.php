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

namespace support\datastructures\linear\dynamic;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyAlreadyExistException, KeyDoesntExistException
};
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use stdClass;

/**
 * ### Test Array data structure class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Arr::class)]
final class ArrTest extends Base {

    public Arr $indexed;
    public Arr $associative;
    public Arr $empty;
    public Arr $mix;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->cls1 = new stdClass();

        $this->indexed = new Arr(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);

        $this->associative = new Arr(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);

        $this->empty = new Arr([]);

        $this->mix = new Arr([$this->cls1, 0, 1, 'one', false, true, null]);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFromArray ():void {

        $this->assertEquals(
            Arr::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]),
            $this->associative
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
            $this->associative->toArray()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExist ():void {

        $this->assertTrue($this->associative->exist('firstname'));
        $this->assertFalse($this->associative->exist('gander'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGet ():void {

        $this->assertSame('John', $this->associative->get('firstname'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->associative->get('gender');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSet ():void {

        $collection = new Arr(['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']);

        $this->associative->set('Jane', 'firstname');
        $this->associative->set('female', 'gender');

        $this->assertEquals($collection, $this->associative);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAdd ():void {

        $collection = new Arr(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']);

        $this->associative->add('female', 'gender');

        $this->assertEquals($collection, $this->associative);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAddException ():void {

        $this->expectException(KeyAlreadyExistException::class);

        $this->associative->add('Jane', 'firstname');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplace ():void {

        $collection = new Arr(['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);

        $this->associative->replace('Jane', 'firstname');

        $this->assertEquals($collection, $this->associative);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testReplaceException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->associative->replace('male', 'gender');

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemove ():void {

        $collection = new Arr(['lastname' => 'Doe', 'age' => 25, 10 => 2]);

        $this->associative->remove('firstname');

        $this->assertEquals($collection, $this->associative);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testRemoveException ():void {

        $this->expectException(KeyDoesntExistException::class);

        $this->associative->remove('gender');

    }

}
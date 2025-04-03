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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ {
    Associative, Mix
};
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use FireHub\Core\Support\Enums\Data\Type;
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

        $mix = new Mix();
        $mix[Type::T_STRING] = 2;
        $mix[Type::T_INT] = 2;

        $this->assertEquals(
            $mix, $this->collection->countBy()->type()
        );

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
    public function testExist ():void {

        $this->assertTrue($this->collection->exist('firstname'));

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
    public function testRemove ():void {

        $collection = new Associative(['lastname' => 'Doe', 'age' => 25, 10 => 2]);

        $this->collection->remove('firstname');

        $this->assertEquals($collection, $this->collection);

    }

}
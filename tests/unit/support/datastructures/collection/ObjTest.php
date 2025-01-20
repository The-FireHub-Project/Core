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
    Obj, Associative
};
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use stdClass;

/**
 * ### Test Object array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Obj::class)]
#[CoversClass(CountBy::class)]
final class ObjTest extends Base {

    public Obj $collection;
    public Obj $empty;
    public Obj $simple;

    public stdClass $cls1;
    public stdClass $cls2;
    public stdClass $cls3;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->cls1 = new stdClass();
        $this->cls2 = new stdClass();
        $this->cls3 = new stdClass();

        $this->collection = new Obj;

        $this->collection[$this->cls1] = 'data for object 1';
        $this->collection[$this->cls2] = [1, 2, 3];
        $this->collection[$this->cls3] = 20;

        $this->empty = new Obj;

        $this->simple = new Obj;

        $this->simple[$this->cls1] = 'data for object 1';
        $this->simple[$this->cls2] = 'data for object 2';

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(3, $this->collection->count());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCountBy ():void {

        $this->assertEquals(
            new Associative(['d' => 2]),
            $this->simple->countBy()->funcAssoc(
                fn($value, $key) => substr((string)$value, 0, 1)
            )
        );

    }

}
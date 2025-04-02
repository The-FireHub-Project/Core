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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};
use stdClass;

/**
 * ### Test Mixed collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Mix::class)]
#[CoversClass(CountBy::class)]
final class MixTest extends Base {

    public Mix $collection;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Mix();
        $this->collection['one'] = 1;
        $this->collection[new stdClass()] = 'two';

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCount ():void {

        $this->assertSame(2, $this->collection->count());

    }

}
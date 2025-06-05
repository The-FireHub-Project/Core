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
    public function testToArray ():void {

        $this->assertSame(
            ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard'],
            $this->collection->toArray()
        );

    }

}
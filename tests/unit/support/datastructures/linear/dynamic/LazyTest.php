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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Lazy data structure class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Lazy::class)]
final class LazyTest extends Base {

    public Lazy $collection;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Lazy(
            fn() => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]
        );

    }

}
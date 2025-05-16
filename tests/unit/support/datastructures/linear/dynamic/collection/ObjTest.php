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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Object array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('collection')]
#[CoversClass(Obj::class)]
final class ObjTest extends Base {

    public Obj $collection;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Obj;

    }

}
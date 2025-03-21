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

namespace support\helpers;

use FireHub\Core\Testing\Base;
use PHPUnit\Framework\Attributes\ {
    CoversFunction, Group, Small
};

use function FireHub\Core\Support\Helpers\Arr\ {
    first, last
};

/**
 * ### Test Data functions
 * @since 1.0.0
 */
#[Small]
#[Group('helpers')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\first')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Arr\last')]
final class ArrTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testFirst ():void {

        $this->assertSame(1, first([1, 2, 3]));
        $this->assertNull(first([]));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testLast ():void {

        $this->assertSame(3, last([1, 2, 3]));
        $this->assertNull(last([]));

    }

}
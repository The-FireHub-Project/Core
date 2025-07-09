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
    CoversFunction, Group, RequiresPhp, Small
};

use function FireHub\Core\Support\Helpers\PHP\ {
    is64bit, is32bit
};

/**
 * ### Test PHP functions
 * @since 1.0.0
 */
#[Small]
#[Group('helpers')]
#[CoversFunction('\FireHub\Core\Support\Helpers\PHP\is64bit')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Data\is32bit')]
final class PHPTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    #[RequiresPhp('>=8.3')]
    public function testPHP ():void {

        $this->assertIsBool(is64bit());
        $this->assertIsBool(is32bit());

    }

}
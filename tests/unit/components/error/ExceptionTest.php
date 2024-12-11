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

namespace components\error;

use FireHub\Core\Testing\Base;
use FireHub\Core\Components\Error\Exception;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test timezone low-level proxy class
 * @since 1.0.0
 */
#[Small]
#[Group('component-error')]
#[CoversClass(Exception::class)]
final class ExceptionTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testDivideError ():void {

        $this->expectException(Exception::class);

        throw new Exception()->withMessage('Hi from exception!')
            ->appendMessage('I am appended massage!')
            ->withCode(10);

    }

}
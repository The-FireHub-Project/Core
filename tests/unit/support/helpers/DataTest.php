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
use FireHub\Core\Support\Enums\Data\ {
    Category, Type
};
use PHPUnit\Framework\Attributes\ {
    CoversFunction, Group, Small
};
use stdClass, Stringable;

use function FireHub\Core\Support\Helpers\Data\ {
    toString, isType
};

/**
 * ### Test Data functions
 * @since 1.0.0
 */
#[Small]
#[Group('helpers')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Data\toString')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Data\isType')]
final class DataTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToString ():void {

        $this->assertSame('true', toString(true));
        $this->assertSame('false', toString(false));
        $this->assertSame('null', toString(null));
        $this->assertSame('10', toString(10));
        $this->assertSame('10.5', toString(10.5));
        $this->assertSame('[1,2,3]', toString([1,2,3]));
        $this->assertSame('stdClass', toString(new stdClass()));
        $this->assertSame('hi!', toString(new class implements Stringable {
            public function __toString():string {
                return 'hi!';
            }
        }));
        $this->assertSame('resource', toString(fopen('php://stdout', 'w')));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIsType ():void {

        $this->assertTrue(isType(10, Type::T_INT));
        $this->assertTrue(isType(10, Category::SCALAR));
        $this->assertFalse(isType(10, Type::T_FLOAT));

    }

}
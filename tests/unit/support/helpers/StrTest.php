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
    CoversFunction, DataProvider, Group, Small
};

use function FireHub\Core\Support\Helpers\Str\asBoolean;

/**
 * ### Test Data functions
 * @since 1.0.0
 */
#[Small]
#[Group('helpers')]
#[CoversFunction('\FireHub\Core\Support\Helpers\Str\asBoolean')]
final class StrTest extends Base {

    /**
     * @since 1.0.0
     *
     * @param string $true
     * @param string $false
     *
     * @return void
     */
    #[DataProvider('values')]
    public function testAsBooleanTrue (string $true, string $false):void {

        $this->assertTrue(asBoolean($true));
        $this->assertFalse(asBoolean($false));

    }

    /**
     * @since 1.0.0
     *
     * @return array
     */
    public static function values ():array {

        return [
            ['true', 'false'],
            ['1', '0'],
            ['on', 'off'],
            ['yes', 'no'],
            ['5', '-4'],
            ['x', ''],
            [' x', ' ']
        ];

    }

}
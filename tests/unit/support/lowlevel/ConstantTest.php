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

namespace support\lowlevel;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\Exceptions\Constant\FailedToDefineException;
use FireHub\Core\Support\LowLevel\Constant;
use PHPUnit\Framework\Attributes\ {
    CoversClass, DataProvider, Depends, Group, Small
};

/**
 * ### Test constant low-level proxy class
 * @since 1.0.0
 */
#[Small]
#[Group('lowlevel')]
#[CoversClass(Constant::class)]
final class ConstantTest extends Base {

    /**
     * @since 1.0.0
     *
     * @param string $string
     * @param null|array|bool|float|int|string $value
     *
     * @return void
     */
    #[DataProvider('constants')]
    public function testDefine (string $string, null|array|bool|float|int|string $value):void {

        $this->assertTrue(Constant::define($string, $value));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    /*public function testDefineFailed ():void {

        $this->expectException(FailedToDefineException::class);

        Constant::define('__LINE__', 'value');

    }*/

    /**
     * @since 1.0.0
     *
     * @param string $string
     * @param null|array|bool|float|int|string $value
     *
     * @return void
     */
    #[DataProvider('constants')]
    #[Depends('testDefine')]
    public function testDefined (string $string):void {

        $this->assertTrue(Constant::defined($string));

    }
    /**
     * @since 1.0.0
     *
     * @return void
     */
    #[Depends('testDefine')]
    public function testValue ():void {

        $this->assertNull(Constant::value('ONE'));
        $this->assertIsString(Constant::value('TWO'));
        $this->assertIsArray(Constant::value('THREE'));
        $this->assertFalse(Constant::value('FOUR'));
        $this->assertIsInt(Constant::value('FIVE'));
        $this->assertIsFloat(Constant::value('SIX'));

    }

    /**
     * @since 1.0.0
     *
     * @return array
     */
    public static function constants ():array {

        return [
            ['ONE', null], ['TWO', 'two'], ['THREE', [1 => 2]], ['FOUR', false], ['FIVE', 4], ['SIX', 10.45]
        ];

    }

}
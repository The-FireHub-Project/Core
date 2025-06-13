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
use FireHub\Core\Support\Exceptions\JSON\ {
    DecodingException, EncodingException
};
use FireHub\Core\Support\LowLevel\JSON;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test JSON low-level proxy class
 * @since 1.0.0
 */
#[Small]
#[Group('lowlevel')]
#[CoversClass(JSON::class)]
final class JSONTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testEncode ():void {

        $this->assertSame('"firehub"', JSON::encode('firehub'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testEncodeException ():void {

        $this->expectException(EncodingException::class);

        JSON::encode("\xB1\x31");

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testDecode ():void {

        $this->assertSame('firehub', JSON::decode('"firehub"'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testDecodeException ():void {

        $this->expectException(DecodingException::class);

        JSON::decode("\xB1\x31");

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testValidate ():void {

        $this->assertTrue(JSON::validate('"firehub"'));

    }

}
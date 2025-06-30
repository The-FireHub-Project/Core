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

namespace support\characters;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\Characters\Codepoint;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Codepoint character class
 * @since 1.0.0
 */
#[Small]
#[Group('char')]
#[CoversClass(Codepoint::class)]
final class CodepointTest extends Base {

    public Codepoint $codepoint;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->codepoint = new Codepoint(43);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPosition ():void {

        $this->assertSame(43, $this->codepoint->position());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCharacter ():void {

        $this->assertSame('+', $this->codepoint->character());

    }

}
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
use FireHub\Core\Support\Char;
use FireHub\Core\Support\Characters\Codepoint;
use FireHub\Core\Support\Enums\String\Encoding;
use PHPUnit\Framework\Attributes\ {
    CoversClass, DataProvider, Group, Small
};

/**
 * ### Test Char character class
 * @since 1.0.0
 */
#[Small]
#[Group('char')]
#[CoversClass(Char::class)]
#[CoversClass(Encoding::class)]
final class CharTest extends Base {

    public Char $control;
    public Char $punctuation;
    public Char $space;
    public Char $char_lower;
    public Char $char_upper;
    public Char $digit;
    public Char $greek;
    public Char $false;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->control = new Char(new Codepoint(0), Encoding::UTF_8);
        $this->punctuation = new Char('}', Encoding::UTF_8);
        $this->space = new Char(' ', Encoding::UTF_8);
        $this->char_lower = new Char('x', Encoding::UTF_8);
        $this->char_upper = new Char('Y', Encoding::UTF_8);
        $this->digit = new Char('4', Encoding::UTF_8);
        $this->greek = new Char('Ϸ', Encoding::UTF_8);
        $this->false = new Char(false, Encoding::UTF_8);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testEncoding ():void {

        $this->assertSame(Encoding::UTF_8, $this->control->encoding());
        $this->assertSame(Encoding::UTF_8, $this->punctuation->encoding());
        $this->assertSame(Encoding::UTF_8, $this->space->encoding());
        $this->assertSame(Encoding::UTF_8, $this->char_lower->encoding());
        $this->assertSame(Encoding::UTF_8, $this->char_upper->encoding());
        $this->assertSame(Encoding::UTF_8, $this->digit->encoding());
        $this->assertSame(Encoding::UTF_8, $this->greek->encoding());

        $this->assertSame(
            $this->control->print(),
            $this->control->encoding(Encoding::ISO_8859_1)->print()
        );

        $this->assertSame(
            $this->punctuation->print(),
            $this->punctuation->encoding(Encoding::ISO_8859_1)->print()
        );

        $this->assertSame(
            $this->space->print(),
            $this->space->encoding(Encoding::ISO_8859_1)->print()
        );

        $this->assertSame(
            $this->char_lower->print(),
            $this->char_lower->encoding(Encoding::ISO_8859_1)->print()
        );

        $this->assertSame(
            $this->char_upper->print(),
            $this->char_upper->encoding(Encoding::ISO_8859_1)->print()
        );

        $this->assertSame(
            $this->digit->print(),
            $this->digit->encoding(Encoding::ISO_8859_1)->print()
        );

        $this->assertSame(
            $this->greek->print(),
            $this->greek->encoding(Encoding::ISO_8859_1)->print()
        );

    }

    /**
     * @since 1.0.0
     *
     * @param string $string
     * @param int $codepoint
     * @param \FireHub\Core\Support\Enums\String\Encoding $encoding
     *
     * @return void
     */
    #[DataProvider('codepoints')]
    public function testCodepoint (string $string, int $codepoint, Encoding $encoding):void {

        $this->assertSame($codepoint, new Char($string, $encoding)->codepoint()->position());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testAsBoolean():void {

        $this->assertTrue($this->control->asBoolean());
        $this->assertTrue($this->punctuation->asBoolean());
        $this->assertFalse($this->space->asBoolean());
        $this->assertTrue($this->char_lower->asBoolean());
        $this->assertTrue($this->char_upper->asBoolean());
        $this->assertTrue($this->digit->asBoolean());
        $this->assertTrue($this->greek->asBoolean());
        $this->assertFalse($this->false->asBoolean());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testToString ():void {

        $this->assertIsString($this->control->__toString());
        $this->assertIsString($this->punctuation->__toString());
        $this->assertIsString($this->space->__toString());
        $this->assertIsString($this->char_lower->__toString());
        $this->assertIsString($this->char_upper->__toString());
        $this->assertIsString($this->digit->__toString());
        $this->assertIsString($this->greek->__toString());
        $this->assertIsString($this->false->__toString());

    }

    /**
     * @since 1.0.0
     *
     * @return array
     */
    public static function codepoints ():array {

        return [
            ['A', 65, Encoding::UTF_8],
            ['?', 63, Encoding::UTF_8],
            ['€', 0x20AC, Encoding::UTF_8],
            ['🐘', 128024, Encoding::UTF_8]
        ];

    }

}
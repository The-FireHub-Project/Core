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
use FireHub\Core\Support\ {
    Str, iStr
};
use FireHub\Core\Support\Char;
use FireHub\Core\Support\Characters\Codepoint;
use FireHub\Core\Support\Enums\String\Encoding;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Str class
 * @since 1.0.0
 */
#[Small]
#[Group('str')]
#[CoversClass(Str::class)]
#[CoversClass(iStr::class)]
#[CoversClass(Encoding::class)]
final class StrTest extends Base {

    public Str $control;
    public Str $string;
    public Str $insensitive_string;
    public Str $string_with_glue;
    public Str $string_with_glue_and_conjunction;
    public Str $string_lower;
    public Str $string_upper;
    public Str $string_with_num;
    public Str $mixed;
    public Str $empty;


    public function setUp ():void {

        $this->control = new Str(new Char(new Codepoint(0))->print());
        $this->string = new Str('FireHub', Encoding::UTF_8);
        $this->insensitive_string = new iStr('FireHub', Encoding::UTF_8);
        $this->string_lower = new Str('firehub', Encoding::UTF_8);
        $this->string_upper = new Str('FIREHUB', Encoding::UTF_8);
        $this->string_with_num = new Str('FireHub123', Encoding::UTF_8);
        $this->mixed = new Str('đščćž 诶杰艾玛 ЛЙ ÈßÁ カタカナ }{:;', Encoding::UTF_8);
        $this->empty = new Str('', Encoding::UTF_8);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testPrint ():void {

        $this->assertSame($this->control->print(), $this->control->__toString());
        $this->assertSame($this->string->print(), $this->string->__toString());
        $this->assertSame($this->insensitive_string->print(), $this->insensitive_string->__toString());
        $this->assertSame($this->string_lower->print(), $this->string_lower->__toString());
        $this->assertSame($this->string_upper->print(), $this->string_upper->__toString());
        $this->assertSame($this->string_with_num->print(), $this->string_with_num->__toString());
        $this->assertSame($this->mixed->print(), $this->mixed->__toString());

    }

}
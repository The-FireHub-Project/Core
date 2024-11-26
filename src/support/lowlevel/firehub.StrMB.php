<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Support
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Support\LowLevel;

use FireHub\Core\Support\Enums\ {
    Side, String\Encoding
};

use function mb_ltrim;
use function mb_rtrim;
use function mb_trim;

/**
 * ### Multibyte string low-level proxy class
 *
 * Class provides multibyte-specific string functions that help you deal with multibyte encodings.
 * @since 1.0.0
 *
 * @internal
 */
final class StrMB extends StrSafe {

    /**
     * ### Strip whitespace (or other characters) from the beginning and end of a string
     *
     * Performs a multibyte safe [[StrSB#trim()]] operation and returns a string with whitespace stripped from
     * the beginning and end of the string.
     * Without the second parameter, [[StrMB#trim()]] will strip these characters:
     *
     * - " " (Unicode U+0020), an ordinary space.
     * - "\t" (Unicode U+0009), a tab.
     * - "\n" (Unicode U+000A), a new line (line feed).
     * - "\r" (Unicode U+000D), a carriage return.
     * - "\0" (Unicode U+0000), the NUL-byte.
     * - "\v" (Unicode U+000B), a vertical tab.
     * - "\f" (Unicode U+000C), a form feed.
     * - "\u00A0" (Unicode U+00A0), a NO-BREAK SPACE.
     * - "\u1680" (Unicode U+1680), a OGHAM SPACE MARK.
     * - "\u2000" (Unicode U+2000), an EN QUAD.
     * - "\u2001" (Unicode U+2001), an EM QUAD.
     * - "\u2002" (Unicode U+2002), an EN SPACE.
     * - "\u2003" (Unicode U+2003), an EM SPACE.
     * - "\u2004" (Unicode U+2004), a THREE-PER-EM SPACE.
     * - "\u2005" (Unicode U+2005), a FOUR-PER-EM SPACE.
     * - "\u2006" (Unicode U+2006), a SIX-PER-EM SPACE.
     * - "\u2007" (Unicode U+2007), a FIGURE SPACE.
     * - "\u2008" (Unicode U+2008), a PUNCTUATION SPACE.
     * - "\u2009" (Unicode U+2009), a THIN SPACE.
     * - "\u200A" (Unicode U+200A), a HAIR SPACE.
     * - "\u2028" (Unicode U+2028), a LINE SEPARATOR.
     * - "\u2029" (Unicode U+2029), a PARAGRAPH SEPARATOR.
     * - "\u202F" (Unicode U+202F), a NARROW NO-BREAK SPACE.
     * - "\u205F" (Unicode U+205F), a MEDIUM MATHEMATICAL SPACE.
     * - "\u3000" (Unicode U+3000), a IDEOGRAPHIC SPACE.
     * - "\u0085" (Unicode U+0085), a NEXT LINE (NEL).
     * - "\u180E" (Unicode U+180E), a MONGOLIAN VOWEL SEPARATOR.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Side::LEFT If trimming string on the left side.
     * @uses \FireHub\Core\Support\Enums\Side::RIGHT If trimming string on the right side.
     *
     * @param string $string <p>
     * The string that will be trimmed.
     * </p>
     * @param \FireHub\Core\Support\Enums\Side $side [optional] <p>
     * Side to trim string.
     * </p>
     * @param null|string $characters [optional] <p>
     * Optionally, the stripped characters can also be specified using the character parameter.
     * List all characters that need to be stripped.
     * </p>
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string The trimmed string.
     */
    public static function trim (string $string, Side $side = Side::BOTH, ?string $characters = null, ?Encoding $encoding = null):string {

        return match($side) {
            Side::LEFT => mb_ltrim($string, $characters, $encoding?->value),
            Side::RIGHT => mb_rtrim($string, $characters, $encoding?->value),
            default => mb_trim($string, $characters, $encoding?->value)
        };

    }

}
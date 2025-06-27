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

namespace FireHub\Core\Support;

use FireHub\Core\Support\Contracts\HighLevel\Characters;
use FireHub\Core\Support\Enums\String\Encoding;
use FireHub\Core\Support\Exceptions\Char\CharacterMustBeSingleCharacterException;
use FireHub\Core\Support\LowLevel\ {
    CharMB, StrMB
};

/**
 * ### Character high-level class
 *
 * Class allows you to manipulate characters in various ways.
 * @since 1.0.0
 *
 * @api
 */
class Char implements Characters {

    /**
     * ### The character
     * @since 1.0.0
     *
     * @var non-empty-string
     */
    private string $character;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\String\Encoding As parameter.
     * @uses \FireHub\Core\Support\LowLevel\StrMB::length() To check the length of the provided character.
     *
     * @param scalar $character <p>
     * The character.
     * </p>
     *
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Char\CharacterMustBeSingleCharacterException If the character is not
     * a single character.
     *
     * @return void
     */
    public function __construct (
        string|int|float|bool $character,
        private ?Encoding $encoding = null
    ) {

        StrMB::length($character = (string)$character) === 1
            ?: throw new CharacterMustBeSingleCharacterException;

        // @phpstan-ignore assign.propertyType
        $this->character = $character;

    }

    /**
     * ### Create a new character from raw string
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\String\Encoding As parameter.
     * @uses \FireHub\Core\Support\LowLevel\CharMB::chr() To get character from codepoint parameter.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Char;
     *
     * Char::from(70);
     *
     * // F
     * ```
     * @example Creating new character with specific encoding.
     * ```php
     * use FireHub\Core\Support\Char;
     * use FireHub\Core\Support\Enums\String\Encoding;
     *
     * $char = Char::from(269, Encoding::UTF_8);
     *
     * // č
     *
     * $char = Char::from(196, Encoding::ISO_8859_1);
     *
     * // č
     * ```
     *
     * @param int $codepoint <p>
     * Codepoint to use.
     * </p>
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Codepoint\CodepointToCharacterException If codepoint couldn't be
     * converted to character.
     * @throws \FireHub\Core\Support\Exceptions\Char\CharacterMustBeSingleCharacterException If the character is not
     * a single character.
     *
     * @return self New character.
     *
     * @see https://en.wikipedia.org/wiki/List_of_Unicode_characters List of codepoint values.
     */
    public static function fromCodepoint (int $codepoint, ?Encoding $encoding = null):self {

        return new self(
            CharMB::chr($codepoint, $encoding),
            $encoding
        );

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\CharMB::ord To get codepoint value from a character.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Char;
     *
     * $char = Char::fromString('F');
     *
     * $char->codepoint();
     *
     * // 70
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Char\CharacterToCodepointException If character couldn't be converted to
     * codepoint.
     */
    public function codepoint ():int {

        return CharMB::ord($this->character, $this->encoding);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Char;
     *
     * echo Char::from('F');
     *
     * // F
     * ```
     */
    public function __toString ():string {

        return $this->character;

    }

}
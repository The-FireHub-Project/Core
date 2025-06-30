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

use FireHub\Core\Support\Contracts\HighLevel\Characters\Codepoint;
use FireHub\Core\Support\Characters\ {
    aChar, Codepoint as CodepointClass
};
use FireHub\Core\Support\Enums\String\Encoding;
use FireHub\Core\Support\Characters\Exceptions\CharacterMustBeSingleCharacterException;
use FireHub\Core\Support\LowLevel\ {
    CharMB, StrMB
};

/**
 * ### Character global class
 * @since 1.0.0
 *
 * @template TCharacter of non-empty-string
 *
 * @extends \FireHub\Core\Support\Characters\aChar<TCharacter>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Char extends aChar {

    /**
     * ### The character
     * @since 1.0.0
     *
     * @var TCharacter
     */
    protected string $character;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\Characters\Codepoint::character() To get character from codepoint.
     *
     * @param TCharacter|int|float|bool|\FireHub\Core\Support\Contracts\HighLevel\Characters\Codepoint $character <p>
     * The character.
     * </p>
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @throws \FireHub\Core\Support\Characters\Exceptions\CharacterMustBeSingleCharacterException If the character is
     * not a single character.
     * @throws \FireHub\Core\Support\Exceptions\Codepoint\CodepointToCharacterException If codepoint couldn't be
     * converted to character.
     *
     * @return void
     */
    public function __construct (
        string|int|float|bool|Codepoint $character,
        private readonly ?Encoding $encoding = null
    ) {

        // @phpstan-ignore assign.propertyType
        $this->character = match(true) {
            $character === false => '0',
            $character instanceof Codepoint => $character->character(),
            StrMB::length((string)$character) !== 1 => throw new CharacterMustBeSingleCharacterException,
            default => (string)$character
        };

    }

    /**
     * ### Get or change character encoding
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\String\Encoding As parameter and return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Char;
     * use FireHub\Core\Support\Enums\String\Encoding;
     *
     * $char = Char::from('F')->encoding(Encoding::UTF_8);
     * ```
     *
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding <p>
     * Character encoding.
     * </p>
     *
     * @throws \FireHub\Core\Support\Characters\Exceptions\CharacterMustBeSingleCharacterException If the character is
     * not a single character.
     * @throws \FireHub\Core\Support\Exceptions\Codepoint\CodepointToCharacterException If codepoint couldn't be
     * converted to character.
     * @throws \FireHub\Core\Support\Exceptions\EncodingException If we couldn't get current encoding.
     *
     * @return ($encoding is null ? \FireHub\Core\Support\Enums\String\Encoding : static) This character with the
     * new encoding or current encoding.
     */
    public function encoding (?Encoding $encoding = null):static|Encoding {

        return $encoding
            ? new static($this->character, $encoding)
            : ($this->encoding ?? StrMB::encoding());

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Characters\Codepoint As codepoint class.
     * @uses \FireHub\Core\Support\LowLevel\CharMB::ord To get codepoint value from a character.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Char;
     *
     * $char = Char::from('F')->codepoint();
     *
     * // 70
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Char\CharacterToCodepointException If character couldn't be converted to
     * codepoint.
     */
    public function codepoint ():Codepoint {

        return new CodepointClass(CharMB::ord($this->character, $this->encoding));

    }

}
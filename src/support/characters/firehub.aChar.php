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

namespace FireHub\Core\Support\Characters;

use FireHub\Core\Support\Contracts\HighLevel\Characters;
use FireHub\Core\Support\Characters\Exceptions\CharacterMustBeSingleCharacterException;
use FireHub\Core\Support\LowLevel\StrMB;

use function FireHub\Core\Support\Helpers\Str\asBoolean;

/**
 * ### Character high-level class
 *
 * Class allows you to manipulate characters in various ways.
 * @since 1.0.0
 *
 * @template TCharacter of non-empty-string
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\Characters<TCharacter>
 */
abstract class aChar implements Characters {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\StrMB::length() To get string length.
     *
     * @param TCharacter $character <p>
     * The character.
     * </p>
     *
     * @throws \FireHub\Core\Support\Characters\Exceptions\CharacterMustBeSingleCharacterException If the character is
     * not a single character.
     *
     * @return void
     */
    public function __construct (
        protected readonly string $character
    ) {

        if (StrMB::length($character) !== 1)
            throw new CharacterMustBeSingleCharacterException;

    }

    /**
     * ### Boolean representation of the given logical character value
     *
     * True – positive-int
     * False – non-positive-int
     * For all other characters, the return value is a result of a boolean cast.
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Char;
     *
     * Char::from('1')->asBoolean();
     *
     * // true
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Regex\ReplaceException If error while performing a regular expression,
     * search and replace.
     *
     * @return bool True or false, based on a boolean representation of the given logical character value.
     */
    public function asBoolean ():bool {

        return asBoolean($this->character);

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
     * Char::from('F')->print();
     *
     * // F
     * ```
     */
    public function print ():string {

        return $this->character;

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
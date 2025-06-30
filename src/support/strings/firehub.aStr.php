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

namespace FireHub\Core\Support\Strings;

use FireHub\Core\Support\Contracts\HighLevel\Strings;

/**
 * ### String high-level abstract class
 *
 * Class allows you to manipulate strings in various ways.
 * @since 1.0.0
 *
 * @template TCharacters of string
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\Strings<TCharacters>
 */
abstract class aStr implements Strings {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param TCharacters $string <p>
     * The string.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected readonly string $string,
    ) { }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Str;
     *
     * Char::from('FireHub')->print();
     *
     * // FireHub
     * ```
     */
    public function print ():string {

        return $this->string;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Str;
     *
     * echo new Str('FireHub');
     *
     * // FireHub
     * ```
     */
    public function __toString ():string {

        return $this->string;

    }

}
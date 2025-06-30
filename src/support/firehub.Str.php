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

use FireHub\Core\Support\Strings\aStr;
use FireHub\Core\Support\Contracts\Magic\Stringable;
use FireHub\Core\Support\Enums\String\Encoding;

/**
 * ### Case-sensitive string high-level class
 *
 * Class allows you to manipulate strings in various ways.
 * @since 1.0.0
 *
 * @template TCharacters of string
 *
 * @extends \FireHub\Core\Support\Strings\aStr<TCharacters>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Str extends aStr {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\Magic\Stringable As parameter.
     * @uses \FireHub\Core\Support\Enums\String\Encoding As parameter.
     *
     * @param TCharacters|int|float|bool|\FireHub\Core\Support\Contracts\Magic\Stringable $string <p>
     * The string.
     * </p>
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return void
     */
    public function __construct (
        string|int|float|bool|Stringable $string,
        protected readonly ?Encoding $encoding = null
    ) {

        if ($string === false) $string = '0';

        // @phpstan-ignore argument.type
        parent::__construct((string)$string);

    }

}
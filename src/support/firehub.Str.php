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
use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
use FireHub\Core\Support\DataStructures\Function\Slice;
use FireHub\Core\Support\Enums\String\Encoding;
use FireHub\Core\Support\LowLevel\StrMB;

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
     * Character encoding.
     * If it is null, the internal character encoding value will be used.
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

    /**
     * ### Create a new string from array elements with a string
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::values() To get values from the data structure.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed::toArray() As an array type if data
     * structure is provided.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed::tail() To get the last data
     * structure item.
     * @uses \FireHub\Core\Support\DataStructures\Function\Slice To get all data structure items expect last one.
     * @uses \FireHub\Core\Support\LowLevel\StrMB::implode() To join array elements with a string.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\Str;
     *
     * Str::fromList(['F', 'i', 'r', 'e', 'H', 'u', 'B']);
     *
     * // FireHub
     * ```
     * @example Creating with glue.
     * ```php
     * use FireHub\Core\Support\Str;
     *
     * Str::fromList(['F', 'i', 'r', 'e', 'H', 'u', 'B'], '-');
     *
     * // F-i-r-e-H-u-b
     * ```
     * @example Creating with glue and conjunction.
     * ```php
     * use FireHub\Core\Support\Str;
     *
     * Str::fromList(['F', 'i', 'r', 'e', 'H', 'u', 'B'], '-', '=');
     *
     * // F-i-r-e-H-u=b
     * ```
     *
     * @param array<array-key, TCharacters>|\FireHub\Core\Support\Contracts\HighLevel\DataStructures<array-key, TCharacters> $list <p>
     * The array of strings to implode.
     * </p>
     * @param TCharacters $glue [optional] <p>
     * The boundary string.
     * </p>
     * @param null|TCharacters $conjunction [optional] <p>
     * Last item separator.
     * </p>
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding [optional] <p>
     * Character encoding.
     * If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\DataException If the array item couldn't be converted to string.
     *
     * @return static<TCharacters> New string containing a string representation of all the array elements in
     * the same order, with the separator string between each element.
     */
    public static function fromList (array|DataStructures $list, string $glue = '', ?string $conjunction = null, ?Encoding $encoding = null):static {

        $list = $list instanceof DataStructures ? $list->values() : new Indexed($list);

        if ($conjunction)
            return new static( // @phpstan-ignore return.type
                StrMB::implode(
                    new Slice($list)(0, -1)->toArray(), $glue
                ).$conjunction.$list->tail(),
                $encoding
            );

        return new static( // @phpstan-ignore return.type
            StrMB::implode($list->toArray(), $glue), $encoding
        );

    }

}
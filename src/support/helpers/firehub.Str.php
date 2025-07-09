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

namespace FireHub\Core\Support\Helpers\Str;

use FireHub\Core\Support\LowLevel\ {
    DataIs, Regex, StrSB
};

/**
 * ### Boolean representation of the given logical string value
 *
 * True – 'true', '1', 'on', 'yes', positive-int
 * False – 'false', '0','off', 'no', non-positive-int, only blanks
 * For all other strings, the return value is a result of a boolean cast.
 * @since 1.0.0
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\String\asBoolean;
 *
 * asBoolean('Yes');
 *
 * // true
 * ```
 *
 * @uses \FireHub\Core\Support\LowLevel\DataIs::null() To check if $map matches any predefined values.
 * @uses \FireHub\Core\Support\LowLevel\DataIs::numeric() To check if $string is a numeric value.
 * @uses \FireHub\Core\Support\LowLevel\StrSB::toLower() To lowercase $string argument.
 * @uses \FireHub\Core\Support\LowLevel\Regex::replace() To replace spaces with empty value.
 *
 * @param string $string <p>
 * String to get the boolean representation.
 * </p>
 *
 * @throws \FireHub\Core\Support\Exceptions\Regex\ReplaceException If error while performing a regular expression,
 * search and replace.
 *
 * @return bool True or false, based on a boolean representation of the given logical string value.
 *
 * @api
 */
function asBoolean (string $string):bool {

    // @phpstan-ignore return.type
    return match (true) {
        !DataIs::null($map = match ($string = StrSB::toLower($string)) {
            'true', '1', 'on', 'yes' => true,
            'false', '0', 'off', 'no' => false,
            default => null
        }) => $map,
        DataIs::numeric($string) => (int)$string > 0,
        default => (bool)Regex::replace('/[[:space:]]+/', '', $string)
    };

}
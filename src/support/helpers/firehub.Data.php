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

namespace FireHub\Core\Support\Helpers\Data;

use FireHub\Core\Support\LowLevel\DataIs;
use Stringable;

/**
 * ### Convert value to string
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To convert $value to string.
 * @uses \FireHub\Core\Support\LowLevel\DataIs::numeric() To convert $value to string.
 * @uses \FireHub\Core\Support\LowLevel\DataIs::array() To convert $value to string.
 * @uses \FireHub\Core\Support\LowLevel\DataIs::object() To convert $value to an object.
 * @uses \FireHub\Core\Support\LowLevel\DataIs::resource() To convert $value to resource.
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Data\toString;
 *
 * toString(true);
 * // 'true'
 *
 * toString(null);
 * // 'null'
 *
 * toString(10);
 * // '10'
 *
 * toString([1,2,3]);
 * // 'array'
 *
 * toString(new stdClass);
 * // 'stdClass'
 *
 * toString(new class implements Stringable {
 *  public function __toString():string {
 *      return 'hi!';
 *  }
 * });
 * // 'hi!'
 * ```
 *
 * @param mixed $value <p>
 * The variable being converted.
 * </p>
 * @param string $default_value [optional] <p>
 * Default value in case $value couldn't be shown as string.
 * </p>
 *
 * @return string Value converted to string.
 *
 * @api
 */
function toString (mixed $value, string $default_value = ''):string {

    return match (true) {
        $value === true => 'true',
        $value === false => 'false',
        $value === null => 'null',
        DataIs::string($value) => $value,
        DataIs::numeric($value) => (string)$value,
        DataIs::array($value) => 'array',
        $value instanceof Stringable => $value->__toString(),
        DataIs::object($value) => $value::class,
        DataIs::resource($value) => 'resource',
        default => $default_value
    };

}
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

namespace FireHub\Core\Support\Helpers\PHP;

use FireHub\Core\Support\LowLevel\PHP;

use const FireHub\Core\Support\Constants\Number\SIZE;

/**
 * ### Check if using a 64bit version of PHP
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\Constants\Number\SIZE To get the size of an integer in bytes in this build of PHP.
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\PHP\is64bit;
 *
 * is64bit();
 *
 * // true
 * ```
 *
 * @return bool True if using the 64bit version of PHP, otherwise false.
 *
 * @api
 */
function is64bit ():bool {

    return SIZE === 8;

}

/**
 * ### Check if using 32bit version of PHP
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\Constants\Number\SIZE To get the size of an integer in bytes in this build of PHP.
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\PHP\is32bit;
 *
 * is32bit();
 *
 * // false
 * ```
 *
 * @return bool True if using the 32bit version of PHP, otherwise false.
 *
 * @api
 */
function is32bit ():bool {

    return SIZE === 4;

}

/**
 * ### Delays program execution for the given number of microseconds
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\PHP::sleep() To delay execution in seconds.
 * @uses \FireHub\Core\Support\LowLevel\PHP::microsleep() To delay execution in microseconds.
 *
 * @param float $seconds_and_microseconds <p>
 * Non-negative number of seconds and microseconds.
 * </p>
 *
 * @return void
 */
function sleep (float $seconds_and_microseconds):void {

    $seconds = (int)$seconds_and_microseconds;

    PHP::sleep(max(0, $seconds));

    $microseconds = min(max(0, (int)(($seconds_and_microseconds - $seconds) * 1_000_000)), 999_999);

    PHP::microsleep($microseconds);

}
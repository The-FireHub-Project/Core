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

use FireHub\Core\Support\Exceptions\Constant\FailedToDefineException;
use Error;

use function constant;
use function define;
use function defined;

/**
 * ### Constant low-level class proxy class
 *
 * Class allows you to collect information about constants.
 * @since 1.0.0
 *
 * @internal
 */
final class Constant {

    /**
     * ### Defines a named constant
     *
     * Defines a named constant at runtime.
     * @since 1.0.0
     *
     * @param non-empty-string $name <p>
     * The name of the constant.
     * </p>
     * @param null|array<array-key, mixed>|scalar $value <p>
     * The value of the constant.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Constant\FailedToDefineException If failed to define constant.
     *
     * @return true True on success.
     */
    public static function define (string $name, null|array|bool|float|int|string $value):true {

        return define($name, $value)
            ?: throw new FailedToDefineException()->withName($name);

    }

    /**
     * ### Checks whether a given named constant exists
     *
     * This function works also with class constants and enum cases.
     * @since 1.0.0
     *
     * @param non-empty-string $name <p>
     * The constant name.
     * </p>
     *
     * @return bool True if the named constant given by name parameter has been defined, false otherwise.
     *
     * @note This function works also with class constants and enum cases.
     */
    public static function defined (string $name):bool {

        return defined($name);

    }

    /**
     * ### Returns the value of a constant
     *
     * Method [[Constant#value()]] is useful if you need to retrieve the value of a constant but don't know its name.
     * In other words, it is stored in a variable or returned by a function.
     * @since 1.0.0
     *
     * @param non-empty-string $name <p>
     * The constant name.
     * </p>
     *
     * @throws Error If the constant is not defined.
     *
     * @return mixed The value of the constant.
     *
     * @note This function works also with class constants and enum cases.
     */
    public static function value (string $name):mixed {

        return constant($name);

    }

}
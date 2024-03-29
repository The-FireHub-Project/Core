<?php declare(strict_types = 1);

/**
 * This file is part of FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2024 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Support
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Support\LowLevel;

use Countable;

use function is_array;
use function is_bool;
use function is_callable;
use function is_countable;
use function is_float;
use function is_int;
use function is_iterable;
use function is_null;
use function is_numeric;
use function is_object;
use function is_resource;
use function is_scalar;
use function is_string;

/**
 * ### Data type checker low-level proxy class
 * @since 1.0.0
 *
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
final class DataIs {

    /**
     * ### Checks if value is array
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is array ? true : false)</code> True if value is array, false otherwise.
     * @phpstan-return ($value is array ? true : false)
     */
    public static function array (mixed $value):bool {

        return is_array($value);

    }

    /**
     * ### Checks if value is boolean
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is bool ? true : false)</code> True if value is boolean, false otherwise.
     * @phpstan-return ($value is bool ? true : false)
     */
    public static function bool (mixed $value):bool {

        return is_bool($value);

    }

    /**
     * ### Verify that the contents of a variable can be called as a function
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is callable ? true : false)</code> True if value is callable, false otherwise.
     * @phpstan-return ($value is callable ? true : false)
     */
    public static function callable (mixed $value):bool {

        return is_callable($value);

    }

    /**
     * ### Verify that the contents of a variable is a countable value
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is array|Countable ? true : false)</code> True if value is countable, false otherwise.
     * @phpstan-return ($value is array|Countable ? true : false)
     */
    public static function countable (mixed $value):bool {

        return is_countable($value);

    }

    /**
     * ### Finds whether the type of variable is a float
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is float ? true : false)</code> True if value is float, false otherwise.
     * @phpstan-return ($value is float ? true : false)
     */
    public static function float (mixed $value):bool {

        return is_float($value);

    }

    /**
     * ### Find whether the type of variable is an integer
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is int ? true : false)</code> True if value is integer, false otherwise.
     * @phpstan-return ($value is int ? true : false)
     */
    public static function int (mixed $value):bool {

        return is_int($value);

    }

    /**
     * ### Verify that the contents of a variable is an iterable value
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is iterable ? true : false)</code> True if value is iterable, false otherwise.
     * @phpstan-return ($value is iterable ? true : false)
     */
    public static function iterable (mixed $value):bool {

        return is_iterable($value);

    }

    /**
     * ### Finds whether a variable is null
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is null ? true : false)</code> True if value is null, false otherwise.
     * @phpstan-return ($value is null ? true : false)
     */
    public static function null (mixed $value):bool {

        return is_null($value);

    }

    /**
     * ### Finds whether a variable is a number or a numeric string
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is numeric ? true : false)</code> True if value is numeric, false otherwise.
     * @phpstan-return ($value is numeric ? true : false)
     */
    public static function numeric (mixed $value):bool {

        return is_numeric($value);

    }

    /**
     * ### Finds whether a variable is an object
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is object ? true : false)</code> True if value is object, false otherwise.
     * @phpstan-return ($value is object ? true : false)
     */
    public static function object (mixed $value):bool {

        return is_object($value);

    }

    /**
     * ### Finds whether a variable is a resource
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is resource ? true : false)</code> True if value is resource, false otherwise or if resource is closed.
     * @phpstan-return ($value is resource ? true : false)
     */
    public static function resource (mixed $value):bool {

        return is_resource($value);

    }

    /**
     * ### Finds whether a variable is a scalar
     *
     * Scalar values include: string, int, float and bool.
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return booL <code>($value is scalar ? true : false)</code> True if value is scalar, false otherwise.
     * @phpstan-return ($value is scalar ? true : false)
     */
    public static function scalar (mixed $value):bool {

        return is_scalar($value);

    }

    /**
     * ### Find whether the type of variable is a string
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool <code>($value is string ? true : false)</code> True if value is string, false otherwise.
     * @phpstan-return ($value is string ? true : false)
     */
    public static function string (mixed $value):bool {

        return is_string($value);

    }

}
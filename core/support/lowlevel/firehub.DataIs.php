<?php declare(strict_types = 1);

/**
 * This file is part of FireHub Web Application Framework package.
 * @since 0.2.0.pre-alpha.M2
 *
 * @author Danijel Galić
 * @copyright 2022 FireHub Web Application Framework
 * @license OSL Open Source License version 3 - [https://opensource.org/licenses/OSL-3.0](https://opensource.org/licenses/OSL-3.0)
 *
 * @package FireHub\Support
 * @version 1.0
 */

namespace FireHub\Support\LowLevel;

use function is_a;
use function is_array;
use function is_bool;
use function is_callable;
use function is_countable;
use function is_executable;
use function is_file;
use function is_finite;
use function is_float;
use function is_dir;
use function is_infinite;
use function is_int;
use function is_iterable;
use function is_link;
use function is_nan;
use function is_null;
use function is_numeric;
use function is_object;
use function is_readable;
use function is_resource;
use function is_scalar;
use function is_string;
use function is_soap_fault;
use function is_subclass_of;
use function is_uploaded_file;
use function is_writable;

/**
 * ### Data Is Check low level class
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
final class DataIs {

    /**
     * ### Checks if the object is of this class or has this class as one of its parents
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string|object $value <p>
     * The tested object.
     * </p>
     * @param class-string $class <p>
     * The class name.
     * </p>
     *
     * @return bool True if value is array, false otherwise.
     */
    public static function ofClass (string|object $value, string $class):bool {

        return is_a($value, $class, true);

    }

    /**
     * ### Checks if value is array
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is array, false otherwise.
     */
    public static function array (mixed $value):bool {

        return is_array($value);

    }

    /**
     * ### Checks if value is boolean
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is boolean, false otherwise.
     */
    public static function bool (mixed $value):bool {

        return is_bool($value);

    }

    /**
     * ### Verify that the contents of a variable can be called as a function
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is callable, false otherwise.
     */
    public static function callable (mixed $value):bool {

        return is_callable($value);

    }

    /**
     * ### Verify that the contents of a variable is a countable value
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is countable, false otherwise.
     */
    public static function countable (mixed $value):bool {

        return is_countable($value);

    }

    /**
     * ### Tells whether the filename is executable
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $filename <p>
     * Path to the file.
     * </p>
     *
     * @return bool True if the filename exists and is executable, or false on error.
     */
    public static function executable (string $filename):bool {

        return is_executable($filename);

    }

    /**
     * ### Tells whether the given file is a regular file
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $filename <p>
     * Path to the file.
     * </p>
     *
     * @return bool True if the filename exists and is a regular file, false otherwise.
     */
    public static function file (string $filename):bool {

        return is_file($filename);

    }

    /**
     * ### Finds whether a value is a legal finite number
     * @since 0.2.0.pre-alpha.M2
     *
     * @param float $number <p>
     * The value to check.
     * </p>
     *
     * @return bool True if number is a legal finite number within the allowed range for a PHP float on this platform, false otherwise.
     */
    public static function finite (float $number):bool {

        return is_finite($number);

    }

    /**
     * ### Finds whether the type of variable is a float
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is float, false otherwise.
     */
    public static function float (mixed $value):bool {

        return is_float($value);

    }

    /**
     * ### Tells whether the filename is a folder
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $filename <p>
     * Path to the file.
     * </p>
     *
     * @return bool Returns true if the filename exists and is a folder, false otherwise.
     */
    public static function folder (string $filename):bool {

        return is_dir($filename);

    }

    /**
     * ### Finds whether a value is infinite
     * @since 0.2.0.pre-alpha.M2
     *
     * @param float $number <p>
     * The value to check.
     * </p>
     *
     * @return bool True if number is infinite, false otherwise.
     */
    public static function infinite (float $number):bool {

        return is_infinite($number);

    }

    /**
     * ### Find whether the type of variable is an integer
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is integer, false otherwise.
     */
    public static function int (mixed $value):bool {

        return is_int($value);

    }

    /**
     * ### Verify that the contents of a variable is an iterable value
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is iterable, false otherwise.
     */
    public static function iterable (mixed $value):bool {

        return is_iterable($value);

    }

    /**
     * ### Tells whether the filename is a symbolic link
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $filename <p>
     * Path to the file.
     * </p>
     *
     * @return bool True if the filename exists and is a symbolic link, false otherwise.
     */
    public static function link (string $filename):bool {

        return is_link($filename);

    }

    /**
     * ### Finds whether a value is not a number
     * @since 0.2.0.pre-alpha.M2
     *
     * @param float $number <p>
     * Value to check.
     * </p>
     *
     * @return bool True if number is 'not a number', false otherwise.
     */
    public static function nan (float $number):bool {

        return is_nan($number);

    }

    /**
     * ### Finds whether a variable is null
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is null, false otherwise.
     */
    public static function null (mixed $value):bool {

        return is_null($value);

    }

    /**
     * ### Finds whether a variable is a number or a numeric string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is numeric, false otherwise.
     */
    public static function numeric (mixed $value):bool {

        return is_numeric($value);

    }

    /**
     * ### Finds whether a variable is an object
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is object, false otherwise.
     */
    public static function object (mixed $value):bool {

        return is_object($value);

    }

    /**
     * ### Tells whether a file exists and is readable
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $filename <p>
     * Path to the file.
     * </p>
     *
     * @return bool True if the file or directory specified by filename exists and is readable, false otherwise.
     */
    public static function readable (string $filename):bool {

        return is_readable($filename);

    }

    /**
     * ### Finds whether a variable is a resource
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is resource, false otherwise.
     */
    public static function resource (mixed $value):bool {

        return is_resource($value);

    }

    /**
     * ### Finds whether a variable is a scalar
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is scalar, false otherwise.
     */
    public static function scalar (mixed $value):bool {

        return is_scalar($value);

    }

    /**
     * ### Find whether the type of variable is a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is string, false otherwise.
     */
    public static function string (mixed $value):bool {

        return is_string($value);

    }

    /**
     * ### Checks if a SOAP call has failed
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $object <p>
     * The object to test.
     * </p>
     *
     * @return bool True on error, and false otherwise.
     */
    public static function soapFault (mixed $object):bool {

        return is_soap_fault($object);

    }

    /**
     * ### Checks if a SOAP call has failed
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string|object $object_or_class <p>
     * Class name or an object instance. No error is generated if the class does not exist.
     * </p>
     * @param class-string $class <p>
     * The class name.
     * </p>
     *
     * @return bool True if the object object_or_class, belongs to a class which is a subclass of class, false otherwise.
     */
    public static function subClassOf (string|object $object_or_class, string $class):bool {

        return is_subclass_of($object_or_class, $class, true);

    }

    /**
     * ### Tells whether the file was uploaded via HTTP POST
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $filename <p>
     * The filename being checked.
     * </p>
     *
     * @return bool True on success, false otherwise.
     */
    public static function uploadedFile (string $filename):bool {

        return is_uploaded_file($filename);

    }

    /**
     * ### Tells whether the filename is writable
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $filename <p>
     * The filename being checked.
     * </p>
     *
     * @return bool True if filename exists and is writable, false otherwise.
     */
    public static function writable (string $filename):bool {

        return is_writable($filename);

    }

}
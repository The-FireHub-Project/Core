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

use Countable;

use const COUNT_NORMAL;
use const COUNT_RECURSIVE;

use function count;
use function current;
use function end;
use function key;
use function next;
use function prev;
use function reset;

/**
 * ### Array or Traversable low-level proxy class
 * @since 1.0.0
 *
 * @internal
 */
final class Iterables {

    /**
     * ### Counts all elements in the array
     * @since 1.0.0
     *
     * @param array<array-key, mixed>|Countable $array <p>
     * Array to count.
     * </p>
     * @param bool $recursive [optional] <p>
     * Recursively count the array.
     * This is particularly useful for counting all the elements of a multidimensional array.
     * </p>
     *
     * @return non-negative-int Number of elements in an array.
     */
    public static function count (array|Countable $array, bool $recursive = false):int {

        return count($array, $recursive ? COUNT_RECURSIVE : COUNT_NORMAL);

    }

    /**
     * ### Return the current element in an array
     *
     * Every array has an internal pointer to its "current" element, which is initialized to the first element
     * inserted into the array.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array.
     * </p>
     *
     * @return TValue|false The [[Iterables#current()]] function simply returns the value of the array element that
     * is being pointed to with the internal pointer.
     * It doesn't move the pointer in any way.
     * If the internal pointer points beyond the end of the element list or the array is empty, [[Iterables#current()]]
     * returns false.
     *
     * @warning This function may return Boolean false but may also return a non-Boolean value which evaluates to false.
     * Read the section on Booleans for more information.
     * Use the === operator for testing the return value of this function.
     * @note The results of calling [[Iterables#current()]] on an empty array and on an array whose internal pointer points
     * beyond the end of the elements is indistinguishable from a bool false element.
     * To properly traverse an array which may contain false elements, see the foreach control structure.
     * To still use [[Iterables#current()]] and properly check if the value is really an element of the array,
     * the [[Iterables#key()]] of the [[Iterables#current()]] element should be checked to be strictly different from
     * null.
     */
    public static function current (array $array):mixed {

        return current($array);

    }

    /**
     * ### Fetch a key from an array
     *
     * Key returns the index element of the current array position.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array.
     * </p>
     *
     * @return null|TKey The [[Iterables#key()]] function simply returns the key of the array element that's
     * currently being pointed to by the internal pointer.
     * It doesn't move the pointer in any way.
     * If the internal pointer points beyond the end of the element list or the array is empty, [[Iterables#key()]]
     * returns null.
     */
    public static function key (array $array):null|int|string {

        return key($array);

    }

    /**
     * ### Rewind the internal array pointer
     *
     * Method [[Iterables#prev()]] behaves like [[Iterables#next()]], except it rewinds the internal array pointer one
     * place instead of advancing it.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * The input array.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return TValue|false Returns the array value in the previous place that is pointed to by the internal array pointer,
     * or false if there are no more elements.
     *
     * @warning This function may return Boolean false but may also return a non-Boolean value which evaluates to false.
     * Read the section on Booleans for more information.
     * Use the === operator for testing the return value of this function.
     * @note The beginning of an array is indistinguishable from a bool false element. To make the distinction, check
     * that the [[Iterables#key()]] of the [[Iterables#prev()]] element is not null.
     */
    public static function prev (array &$array):mixed {

        return prev($array);

    }

    /**
     * ### Advance the internal pointer of an array
     *
     * Method [[Iterables#next()]] behaves like [[Iterables#current()]], with one difference.
     * It advances the internal array pointer one place forward before returning the element value.
     * That means it returns the next array value and advances the internal array pointer by one.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * The array being affected.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return TValue|false Returns the array value in the next place that is pointed to by the internal array
     * pointer, or false if there are no more elements.
     *
     * @warning This function may return Boolean false but may also return a non-Boolean value which evaluates to false.
     * Read the section on Booleans for more information.
     * Use the === operator for testing the return value of this function.
     * @note The end of an array is indistinguishable from a bool false element.
     * To properly traverse an array which may contain false elements, see the foreach function.
     * To still use [[Iterables#next()]] and properly check if the end of the array has been reached, verify that the
     * [[Iterables#key()]] is null.
     */
    public static function next (array &$array):mixed {

        return next($array);

    }

    /**
     * ### Set the internal pointer of an array to its first element
     *
     * Method [[Iterables#reset()]] rewinds the array's internal pointer to the first element and returns the value of
     * the first array element.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * The input array.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return TValue|false Returns the value of the first array element, or false if the array is empty.
     *
     * @warning This function may return Boolean false but may also return a non-Boolean value which evaluates to false.
     * Read the section on Booleans for more information.
     * Use the === operator for testing the return value of this function.
     * @note The return value for an empty array is indistinguishable from the return value in the case of an array
     * which has a bool false first element.
     * To properly check the value of the first element in an array which may contain false elements, first check the
     * [[Iterables#count()]] of the array, or check that [[Iterables#key()]] is not null, after calling
     * [[Iterables#reset()]].
     */
    public static function reset (array &$array):mixed {

        return reset($array);

    }

    /**
     * ### Set the internal pointer of an array to its last element
     *
     * Method [[Iterables#end()]] advances the array's internal pointer to the last element and returns its value.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * The input array.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return TValue|false Returns the value of the last element or false for an empty array.
     *
     * @warning This function may return Boolean false but may also return a non-Boolean value which evaluates to false.
     * Read the section on Booleans for more information.
     * Use the === operator for testing the return value of this function.
     */
    public static function end (array &$array):mixed {

        return end($array);

    }

}
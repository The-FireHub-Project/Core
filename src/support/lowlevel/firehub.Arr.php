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

use FireHub\Core\Support\Enums\ {
    Order, Sort, String\CaseFolding
};
use FireHub\Core\Support\Exceptions\Arr\ {
    ChunkLengthTooSmallException, FailedSortMultiArrayException, KeysAndValuesDiffNumberOfElemsException,
    OutOfRangeException, SizeInconsistentException, WalkArgumentCountException
};
use ArgumentCountError, ValueError;

use const FireHub\Core\Support\Constants\Number\MAX_32_BIT;
use const ARRAY_FILTER_USE_BOTH;
use const ARRAY_FILTER_USE_KEY;
use const CASE_LOWER;
use const CASE_UPPER;
use const SORT_REGULAR;

use function array_all; // @phpstan-ignore function.notFound (@todo fix on PHP 8.4)
use function array_any; // @phpstan-ignore function.notFound (@todo fix on PHP 8.4)
use function array_change_key_case;
use function array_chunk;
use function array_column;
use function array_combine;
use function array_count_values;
use function array_diff;
use function array_diff_assoc;
use function array_diff_key;
use function array_diff_uassoc;
use function array_diff_ukey;
use function array_fill;
use function array_fill_keys;
use function array_filter;
use function array_find; // @phpstan-ignore function.notFound (@todo fix on PHP 8.4)
use function array_find_key; // @phpstan-ignore function.notFound (@todo fix on PHP 8.4)
use function array_flip;
use function array_intersect;
use function array_intersect_assoc;
use function array_intersect_key;
use function array_intersect_uassoc;
use function array_intersect_ukey;
use function array_is_list;
use function array_key_exists;
use function array_key_first;
use function array_key_last;
use function array_keys;
use function array_map;
use function array_merge;
use function array_merge_recursive;
use function array_multisort;
use function array_pad;
use function array_pop;
use function array_product;
use function array_push;
use function array_rand;
use function array_reduce;
use function array_replace;
use function array_replace_recursive;
use function array_reverse;
use function array_search;
use function array_shift;
use function array_slice;
use function array_splice;
use function array_sum;
use function array_udiff;
use function array_udiff_assoc;
use function array_udiff_uassoc;
use function array_uintersect;
use function array_uintersect_assoc;
use function array_uintersect_uassoc;
use function array_unique;
use function array_unshift;
use function array_values;
use function array_walk;
use function array_walk_recursive;
use function arsort;
use function asort;
use function rsort;
use function in_array;
use function krsort;
use function ksort;
use function range;
use function shuffle;
use function sort;
use function uasort;
use function uksort;
use function usort;

/**
 * ### Array low-level proxy class
 * @since 1.0.0
 *
 * @internal
 */
final class Arr {

    /**
     * ### Checks if all array elements satisfy a callback function
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array that should be searched.
     * </p>
     * @param callable(TValue, TKey=):mixed $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return bool True if callback returns true for all elements, false otherwise.
     */
    public static function all (array $array, callable $callback):bool {

        return array_all($array, $callback); // @phpstan-ignore argument.type

    }

    /**
     * ### Checks if at least one array element satisfies a callback function
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array that should be searched.
     * </p>
     * @param callable(TValue, TKey=):mixed $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return bool True if there is at least one element for which callback returns true, false otherwise.
     */
    public static function any (array $array, callable $callback):bool {

        return array_any($array, $callback); // @phpstan-ignore argument.type

    }

    /**
     * ### Checks if the given key or index exists in the array
     *
     * Returns true if the given key is set in the array.
     * Key can be any value possible for an array index.
     * @since 1.0.0
     *
     * @param array-key $key <p>
     * Key to check.
     * </p>
     * @param array<array-key, mixed> $array <p>
     * An array with keys to check.
     * </p>
     *
     * @return bool True if the key exists in an array, false otherwise.
     *
     * @note Method will search for the keys in the first dimension only.
     * Nested keys in multidimensional arrays will not be found.
     */
    public static function keyExist (int|string $key, array $array):bool {

        return array_key_exists($key, $array);

    }

    /**
     * ### Checks if a value exists in an array
     * @since 1.0.0
     *
     * @param mixed $value <p>
     * The searched value.
     * If a needle is a string, the comparison is done in a case-sensitive manner.
     * </p>
     * @param array<array-key, mixed> $array <p>
     * The array.
     * </p>
     *
     * @return bool True if a value is found in the array, false otherwise.
     */
    public static function inArray (mixed $value, array $array):bool {

        return in_array($value, $array, true);

    }

    /**
     * ### Checks whether a given array is a list
     *
     * Determines if the given array is a list.
     * An array is considered a list if its keys consist of consecutive numbers from 0 to count($array)-1.
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $array <p>
     * The array is being evaluated.
     * </p>
     *
     * @return ($array is list ? true: false) True if an array is a list, false otherwise.
     *
     * @note This function returns true on empty arrays.
     */
    public static function isList (array $array):bool {

        return array_is_list($array);

    }

    /**
     * ### Sort multiple on multidimensional arrays
     * @since 1.0.0
     *
     * @param array<array-key, array<array-key, mixed>> $array <p>
     * A multidimensional array being sorted.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\FailedSortMultiArrayException Failed to sort a multi-sort array.
     * @throws \FireHub\Core\Support\Exceptions\Arr\SizeInconsistentException If array sizes are inconsistent.
     *
     * @return bool True on success.
     *
     * @caution Associative (string) keys will be maintained, but numeric keys will be re-indexed.
     * @note Resets array's internal pointer to the first element.
     *
     * @phpstan-ignore return.phpDocType (PHPStan reports that the method could still return bool)
     */
    public static function multiSort (array $array):true {

        try {

            return array_multisort(...$array)
                ?: throw new FailedSortMultiArrayException;

        } catch (ValueError) {

            throw new SizeInconsistentException;

        }

    }

    /**
     * ### Apply a user function to every member of an array
     *
     * Applies the user-defined callback function to each element of the array $array.
     * Method is not affected by the internal array pointer of an array.
     * Method will walk through the entire array regardless of pointer position.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * The array to apply a user function.
     * </p>
     * @param callable(TValue, TKey):mixed $callback <p>
     * Typically, the function name takes on two parameters.
     * The array parameter's value is the first, and the key/index second.
     * If a function name needs to be working with the actual values of the array, specify the first parameter of the
     * function name as a reference.
     * Then, any changes made to those elements will be made in the original array itself.
     * Users may not change the array itself from the callback function, for example, add/delete elements, unset
     * elements, and so on.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\WalkArgumentCountException If the $callback function requires more
     * than two parameters.
     *
     * @return true True on success.
     */
    public static function walk (array &$array, callable $callback):true {

        try {

            return array_walk($array, $callback);

        } catch (ArgumentCountError) {

            throw new WalkArgumentCountException;

        }

    }

    /**
     * ### Apply a user function recursively to every member of an array
     *
     * Applies the user-defined callback function to each element of the array.
     * This function will recurse into deeper arrays.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * The array to apply a user function.
     * </p>
     * @param callable(TValue, TKey):mixed $callback <p>
     * Typically, the function name takes on two parameters.
     * The array parameter's value is the first, and the key/index second.
     * If a function name needs to be working with the actual values of the array, specify the first parameter of the
     * function name as a reference.
     * Then, any changes made to those elements will be made in the original array itself.
     * Users may not change the array itself from the callback function.
     * For example, Add/delete elements, unset elements, and so on.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\WalkArgumentCountException If the $callback function requires more
     * than two parameters.
     *
     * @return true True on success.
     */
    public static function walkRecursive (array &$array, callable $callback):true {

        try {

            return array_walk_recursive($array, $callback);

        } catch (ArgumentCountError) {

            throw new WalkArgumentCountException;

        }

    }

    /**
     * ### Counts the occurrences of each distinct value in an array
     *
     * Returns an array using the values of $array (which must be int-s or strings) as keys and their frequency in an
     * $array as values.
     * @since 1.0.0
     *
     * @template TValue of array-key
     *
     * @param array<array-key, TValue> $array <p>
     * The array of values to count.
     * </p>
     *
     * @return array<array-key, positive-int> An associative array of values from input as keys and their count as
     * value.
     */
    public static function countValues (array $array):array {

        return array_count_values($array);

    }

    /**
     * ### Fill an array with values
     *
     * Fills an array with $length entries of the value for the $value parameter, keys starting at the $start_index
     * parameter.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Number\MAX_32_BIT As maximum length for $length parameter.
     *
     * @template TValue
     *
     * @param TValue $value <p>
     * Value to use for filling.
     * </p>
     * @param int $start_index <p>
     * The first index of the returned array.
     * </p>
     * @param int<0, 2147483648> $length <p>
     * Number of elements to insert. Must be greater than or equal to zero.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException If $length is out of range.
     *
     * @return array<int, TValue> Filled array.
     */
    public static function fill (mixed $value, int $start_index, int $length):array {

        return !($length < 0) && !($length >= MAX_32_BIT)
            ? array_fill($start_index, $length, $value)
            : throw new OutOfRangeException()
                ->appendMessage("Current length is: {$length}, but it must be greater than or equal to zero, but less than 2147483648.");

    }

    /**
     * ### Fill an array with values, specifying keys
     *
     * Fills an array with the value of the $value parameter, using the values of the $keys array as keys.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<array-key, TKey> $keys <p>
     * Array of values that will be used as keys.
     * Illegal values for a key will be converted to string.
     * </p>
     * @param TValue $value <p>
     * Value to use for filling.
     * </p>
     *
     * @return array<TKey, TValue> The filled array.
     */
    public static function fillKeys (array $keys, mixed $value):array {

        return array_fill_keys($keys, $value);

    }

    /**
     * ### Changes the case of all keys in an array
     *
     * Returns an array with all keys from an array lowercased or uppercased.
     * Numbered indices are left as is.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\String\CaseFolding::LOWER As default parameter.
     * @uses \FireHub\Core\Support\Enums\String\CaseFolding::UPPER To fold keys to uppercase.
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to work on.
     * </p>
     * @param (\FireHub\Core\Support\Enums\String\CaseFolding::LOWER|\FireHub\Core\Support\Enums\String\CaseFolding::UPPER) $case [optional] <p>
     * Either LOWER or UPPER case folding.
     * </p>
     *
     * @return array<TKey, TValue> An array with its keys lower or uppercased.
     */
    public static function foldKeys (array $array, CaseFolding $case = CaseFolding::LOWER):array {

        return array_change_key_case($array, $case === CaseFolding::UPPER ? CASE_UPPER : CASE_LOWER);

    }

    /**
     * ### Split an array into chunks
     *
     * Chunks an array into arrays with $length elements.
     * The last chunk may contain less than $length elements.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array.
     * </p>
     * @param positive-int $length <p>
     * The size of each chunk.
     * If the length is less than 1, it will default to 1.
     * </p>
     * @param bool $preserve_keys [optional] <p>
     * When set to true, keys will be preserved.
     * Default is false that will reindex the chunk numerically.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\ChunkLengthTooSmallException If the length is less than 1.
     *
     * @return ($preserve_keys is true ? list<array<TKey, TValue>> : list<list<TValue>>) Multidimensional numerically
     * indexed array, starting with zero, with each dimension contains $length elements.
     */
    public static function chunk (array $array, int $length, bool $preserve_keys = false):array {

        return !($length < 1)
            ? array_chunk($array, $length, $preserve_keys)
            : throw new ChunkLengthTooSmallException()->withLength($length);

    }

    /**
     * ### Return the values from a single column in the input array
     *
     * Returns the values from a single column of the $array, identified by the $key.
     * Optionally, an argument key may be provided to $index the values in the returned array by the values from the
     * index argument column of the input array.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<array-key, array<TKey, TValue>> $array <p>
     * A multidimensional array (record set) from which to pull a column of values.
     * If an array of objects is provided, then public properties can be directly pulled.
     * In order for protected or private properties to be pulled, the class must implement both the __get() and
     * __isset() magic methods.
     * </p>
     * @param int|string $key <p>
     * The column of values to return.
     * This value may be an integer key of the column you wish to retrieve, or it may be a string key name for an
     * associative array or property name.
     * It may also be null to return complete arrays or objects (this is useful together with $index to reindex the
     * array).
     * </p>
     * @param null|int|string $index [optional] <p>
     * The column to use as the index/keys for the returned array.
     * This value may be the integer key of the column, or it may be the string key name.
     * The value is cast as usual for array keys.
     * </p>
     *
     * @return ($index is null ? TValue[] : array<TValue, TValue>) Array of values representing a single column from
     * the input array.
     */
    public static function column (array $array, int|string $key, null|int|string $index = null):array {

        return array_column($array, $key, $index); // @phpstan-ignore return.type

    }

    /**
     * ### Creates an array by using one array for keys and another for its values
     *
     * Creates an array by using the values from the $keys array as keys and the values from the $values array as the
     * corresponding values.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<array-key, TKey> $keys <p>
     * Array of values to be used as keys.
     * Illegal values for a key will be converted to string.
     * </p>
     * @param array<array-key, TValue> $values <p>
     * Array of values to be used as values on a combined array.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\KeysAndValuesDiffNumberOfElemsException If arguments $keys and
     * $values don't have the same number of elements.
     *
     * @return array<TKey, TValue> The combined array.
     */
    public static function combine (array $keys, array $values):array {

        try {

            return array_combine($keys, $values);

        } catch (ValueError) {

            throw new KeysAndValuesDiffNumberOfElemsException;

        }

    }

    /**
     * ### Computes the difference of arrays using values for comparison
     *
     * Compares an array against one or more other arrays and returns the values in an array that aren't present in any
     * of the other arrays.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> ...$excludes [optional] <p>
     * An array to compare against.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that aren't present in any of
     * the other arrays.
     *
     * @note This function only checks one dimension of an n-dimensional array.
     * You can check deeper dimensions by using [[Arr#difference($array1[0], $array2[0])]].
     */
    public static function difference (array $array, array ...$excludes):array {

        return array_diff($array, ...$excludes);

    }

    /**
     * ### Computes the difference of arrays using values for comparison by using a callback for comparison
     *
     * Computes the difference of arrays by using a callback function for data comparison.
     * This is unlike [[Arr#difference()]] which uses an internal function for comparing the data.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback <p>
     * The comparison function must return an integer less than, equal to, or greater than zero if the first argument
     * is considered to be respectively less than, equal to, or greater than the second.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that aren't present in any of
     * the other arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note Note that this function only checks one dimension of an n-dimensional array.
     * Of course, you can check deeper dimensions by using
     * [[Arr#differenceFunc($array1[0], $array2[0]), 'data_compare_func']].
     */
    public static function differenceFunc (array $array, array $excludes, callable $callback):array {

        return array_udiff($array, $excludes, $callback);

    }

    /**
     * ### Computes the difference of arrays using keys for comparison
     *
     * Compares the keys from an array against the keys from arrays and returns the difference.
     * This function is like [[Arr#difference()]] except the comparison is done on the keys instead of the values.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> ...$excludes [optional] <p>
     * An array to compare against.
     * </p>
     *
     * @return array<TKey, TValue> Returns an array containing all the entries from an array whose keys are absent from
     * all the other arrays.
     *
     * @note This function only checks one dimension of an n-dimensional array.
     * Of course, you can check deeper dimensions by using [[Arr#differenceKey($array1[0], $array2[0])]].
     */
    public static function differenceKey (array $array, array ...$excludes):array {

        return array_diff_key($array, ...$excludes);

    }

    /**
     * ### Computes the difference of arrays using keys for comparison by using a callback for data comparison
     *
     * Compares the keys from an array against the keys from arrays and returns the difference.
     * This function is like [[Arr#difference()]] except the comparison is done on the keys instead of the values.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback <p>
     * The comparison function.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that aren't present in any of
     * the other arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note This function only checks one dimension of an n-dimensional array.
     * Of course, you can check deeper dimensions by using
     * [[Arr#differenceKeyFunc($array1[0], $array2[0], 'callback_func')]].
     */
    public static function differenceKeyFunc (array $array, array $excludes, callable $callback):array {

        return array_diff_ukey($array, $excludes, $callback);

    }

    /**
     * ### Computes the difference of arrays with additional index check
     *
     * Compares an array against arrays and returns the difference.
     * Unlike [[Arr#difference()]], the array keys are also used in the comparison.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> ...$excludes [optional] <p>
     * An array to compare against.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that aren't present in any of
     * the other arrays.
     *
     * @note This function only checks one dimension of an n-dimensional array.
     * It is possible to check deeper dimensions by using, for example, [[Arr#differenceAssoc($array1[0], $array2[0])]].
     * @note Ensure arguments are passed in the correct order when comparing similar arrays with more keys.
     * The new array should be the first in the list.
     */
    public static function differenceAssoc (array $array, array ...$excludes):array {

        return array_diff_assoc($array, ...$excludes);

    }

    /**
     * ### Computes the difference of arrays with additional index check by using a callback for value comparison
     *
     * Computes the difference of arrays with an additional index check, compares data by a callback function.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<array-key, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<TKey, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback <p>
     * The comparison function.
     * </p>
     *
     * @return TValue[] An array containing all the entries from $array that aren't present in any of the other
     * arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note Note that this function only checks one dimension of an n-dimensional array.
     * Of course, you can check deeper dimensions by using, for example,
     * [[Arr#differenceAssocFuncValue($array1[0], $array2[0], 'some_comparison_func')]].
     */
    public static function differenceAssocFuncValue (array $array, array $excludes, callable $callback):array {

        return array_udiff_assoc($array, $excludes, $callback);

    }

    /**
     * ### Computes the difference of arrays with additional index check by using a callback for key comparison
     *
     * Compares an array against arrays and returns the difference.
     * Unlike [[Arr#difference()]], the array keys are used in the comparison.
     * Unlike [[Arr#differenceAssoc()]], a user-supplied callback function is used for the indices comparison, not an
     * internal function.
     * @since 1.0.0
     *
     * @template TKey
     * @template TValue
     *
     * @param array<array-key, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<TKey, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback <p>
     * The comparison function.
     * </p>
     *
     * @return TValue[] Returns an array containing all the entries from $array that aren't present in any of
     * the other arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note This function only checks one dimension of an n-dimensional array.
     * It is possible to check deeper dimensions by using, for example,
     * [[Arr#differenceAssocFuncKey($array1[0], $array2[0], 'key_compare_func')]].
     */
    public static function differenceAssocFuncKey (array $array, array $excludes, callable $callback):array {

        return array_diff_uassoc($array, $excludes, $callback);

    }

    /**
     * ### Computes the difference of arrays with additional index check by using a callback for key-value comparison
     *
     * Computes the difference of arrays with additional index check, compares data and indexes by a callback function.
     * Note that the keys are used in the comparison unlike [[Arr#difference()]] and [[Arr#differenceFunc()]].
     * @since 1.0.0
     *
     * @template TKey
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback_value <p>
     * The comparison function for value.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback_key <p>
     * The comparison function for key.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that aren't present in any of
     * the other arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note This function only checks one dimension of an n-dimensional array.
     * It is possible to check deeper dimensions by using, for example,
     * [[Arr#differenceAssocFuncKeyValue($array1[0], $array2[0], 'data_compare_func', 'key_compare_func')]].
     */
    public static function differenceAssocFuncKeyValue (array $array, array $excludes, callable $callback_value, callable $callback_key):array {

        return array_udiff_uassoc($array, $excludes, $callback_value, $callback_key);

    }

    /**
     * ### Computes the intersection of arrays using values for comparison
     *
     * Returns an array containing all the values of an array that are present in all the arguments.
     * Note that keys are preserved.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array with main values to check.
     * </p>
     * @param array<array-key, mixed> ...$arrays [optional] <p>
     * An array to compare values against.
     * </p>
     *
     * @return array<TKey, TValue> The filtered array.
     *
     * @note Two elements are considered equal if and only if (string) $elem1 === (string) $elem2.
     * In words: when the string representation is the same.
     */
    public static function intersect (array $array, array ...$arrays):array {

        return array_intersect($array, ...$arrays);

    }

    /**
     * ### Computes the intersection of arrays using values for comparison by using a callback for data comparison
     *
     * Computes the intersection of arrays, compares data by a callback function.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback <p>
     * The comparison function.
     * </p>
     *
     * @return array<TKey, TValue> Arrays containing all the entries from $array that are present in any of the other
     * arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note Two elements are considered equal if and only if (string) $elem1 === (string) $elem2.
     * In words: when the string representation is the same.
     */
    public static function intersectFunc (array $array, array $excludes, callable $callback):array {

        return array_uintersect($array, $excludes, $callback);

    }

    /**
     * ### Computes the intersection of arrays using keys for comparison
     *
     * Returns an array containing all the entries of an array which have keys that are present in all the arguments.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array with main values to check.
     * </p>
     * @param array<array-key, mixed> ...$arrays [optional] <p>
     * An array to compare values against.
     * </p>
     *
     * @return array<TKey, TValue> The filtered array.
     */
    public static function intersectKey (array $array, array ...$arrays):array {

        return array_intersect_key($array, ...$arrays);

    }

    /**
     * ### Computes the intersection of arrays using keys for comparison by using a callback for data comparison
     *
     * Returns an array containing all the values of an array which have matching keys that are present in all the
     * arguments.
     * @since 1.0.0
     *
     * @template TKey
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback <p>
     * The comparison function.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that are present in any of the other arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     */
    public static function intersectKeyFunc (array $array, array $excludes, callable $callback):array {

        return array_intersect_ukey($array, $excludes, $callback);

    }

    /**
     * ### Computes the intersection of arrays with additional index check
     *
     * Returns an array containing all the values of an array that are present in all the arguments.
     * Note that the keys are also used in the comparison unlike in [[Arr#intersect()]].
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array with main values to check.
     * </p>
     * @param array<array-key, mixed> ...$arrays [optional] <p>
     * An array to compare values against.
     * </p>
     *
     * @return array<TKey, TValue> The filtered array.
     *
     * @note The two values from the key → value pairs are considered equal only if (string) $elem1 === (string) $elem2.
     * In other words, a strict type check is executed, so the string representation must be the same.
     */
    public static function intersectAssoc (array $array, array ...$arrays):array {

        return array_intersect_assoc($array, ...$arrays);

    }

    /**
     * ### Computes the intersection of arrays with additional index check by using a callback for value comparison
     *
     * Computes the intersection of arrays with additional index check, compares data by a callback function.
     * Note that the keys are used in the comparison unlike in [[Arr#intersectFunc()]].
     * The data is compared by using a callback function.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback $callback <p>
     * The comparison function.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that are present in any of
     * the other arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     */
    public static function intersectAssocFuncValue (array $array, array $excludes, callable $callback):array {

        return array_uintersect_assoc($array, $excludes, $callback);

    }

    /**
     * ### Computes the intersection of arrays with additional index check by using a callback for key comparison
     *
     * Computes the intersection of arrays with additional index check, compares data and indexes by separate
     * callback functions.
     * @since 1.0.0
     *
     * @template TKey
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback <p>
     * The comparison function.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that are present in any of the other
     * arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note The comparison function must return an integer less than, equal to, or greater than zero if the first
     * argument is considered to be respectively less than, equal to, or greater than the second.
     */
    public static function intersectAssocFuncKey (array $array, array $excludes, callable $callback):array {

        return array_intersect_uassoc($array, $excludes, $callback);

    }

    /**
     * ### Computes the intersection of arrays with additional index check by using a callback for key-value comparison
     *
     * Computes the intersection of arrays with additional index check, compares data and indexes by separate
     * callback functions.
     * @since 1.0.0
     *
     * @template TKey
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to compare from.
     * </p>
     * @param array<array-key, mixed> $excludes <p>
     * An array to compare against.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback_value <p>
     * The comparison function for value.
     * </p>
     * @param callable(mixed, mixed):int<-1, 1> $callback_key <p>
     * The comparison function for key.
     * </p>
     *
     * @return array<TKey, TValue> An array containing all the entries from $array that are present in any of the other
     * arrays.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     * @note The comparison function must return an integer less than, equal to, or greater than zero if the first
     * argument is considered to be respectively less than, equal to, or greater than the second.
     */
    public static function intersectAssocFuncKeyValue (array $array, array $excludes, callable $callback_value, callable $callback_key):array {

        return array_uintersect_uassoc($array, $excludes, $callback_value, $callback_key);

    }

    /**
     * ### Filter elements in an array
     *
     * Iterates over each value in the $array, passing them to the $callback function.
     * If the $callback function returns true, the current value from an $array is returned into the result array.
     * Array keys are preserved and may result in gaps if the $array was indexed.
     * The result array can be re-indexed using the [[Arr#values()]] function.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\DataIs::null To find whether a callable parameter is null.
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to iterate over.
     * </p>
     * @param null|callable(TValue, TKey=):bool $callback [optional] <p>
     * The callback function to use.
     * If no callback is supplied, all empty and false entries of an array will be removed.
     * </p>
     * @param bool $pass_value [optional] <p>
     * Pass value as the argument to callback.
     * </p>
     * @param bool $pass_key [optional] <p>
     * Pass key as the argument to callback.
     * </p>
     *
     * @return array<TKey, TValue> Filtered array.
     *
     * @caution If the array is changed from the callback function (for example, an element added, deleted, or unset),
     * then the behavior of this function is undefined.
     */
    public static function filter (array $array, ?callable $callback = null, bool $pass_value = false, bool $pass_key = false):array {

        if (DataIs::null($callback)) return array_filter($array);

        return array_filter($array, $callback, match (true) {
            $pass_value && $pass_key => ARRAY_FILTER_USE_BOTH,
            $pass_key => ARRAY_FILTER_USE_KEY,
            default => 0
        });

    }

    /**
     * ### Exchanges all keys with their associated values in an array
     *
     * Returns an array in flip order; in other words, keys from an $array become values, and values from an $array
     * become keys.
     * Note that the values of $array need to be valid keys; in other words, they need to be either int or string.
     * A warning will be emitted if a value has the wrong type, and the key/value pair in question will not be
     * included in the result.
     * If a value has several occurrences, the latest key will be used as its value, and all others will be lost.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue of array-key
     *
     * @param array<TKey, TValue> $array <p>
     * The array to flip.
     * </p>
     *
     * @return array<TValue, TKey> The flipped array.
     */
    public static function flip (array $array):array {

        return array_flip($array);

    }

    /**
     * ### Return all the keys or a subset of the keys for an array
     *
     * Returns the keys, numeric, and string, from the $array.
     * If a $filter is specified, then only the keys for that value are returned.
     * Otherwise, all the keys from the array are returned.
     * @since 1.0.0
     *
     * @template TKey of array-key
     *
     * @param array<TKey, mixed> $array <p>
     * An array containing keys to return.
     * </p>
     * @param mixed $filter [optional] <p>
     * If specified, then only keys containing these values are returned.
     * </p>
     *
     * @return list<TKey> An array of all the keys in input.
     */
    public static function keys (array $array, mixed $filter = null):array {

        return $filter
            ? array_keys($array, $filter, true)
            : array_keys($array);

    }

    /**
     * ### Return all the values from an array
     *
     * Returns all the values from the array and indexes the array numerically.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<array-key, TValue> $array <p>
     * The array.
     * </p>
     *
     * @return TValue[] An indexed array of values.
     */
    public static function values (array $array):array {

        return array_values($array);

    }

    /**
     * ### Applies the callback to the elements of the given array
     *
     * Returns an array containing the results of applying the $callback to the corresponding value of an $array used as
     * arguments for the callback.
     * The number of parameters that the $callback function accepts should match the number of arrays passed to
     * [[Arr#map()]]. Excess input arrays are ignored.
     * An ArgumentCountError is thrown if an insufficient number of arguments is provided.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * Array to run through the callback function.
     * </p>
     * @param callable(TValue):mixed $callback <p>
     * Callback function to run for each element in each array.
     * Null can be passed as a value to $callback to perform a zip operation on multiple arrays. If only an array is
     * provided, [[Arr#map()]] will return the input array.
     * </p>
     *
     * @return array<TKey, mixed> Array containing all the elements of arr1 after applying the callback function.
     */
    public static function map (array $array, callable $callback):array {

        return array_map($callback, $array);

    }

    /**
     * ### Merges the elements of one or more arrays
     *
     * Merges the elements of one or more arrays so that the values of one are appended to the end of the previous
     * one.
     * It returns the resulting array.
     * If the input arrays have the same string keys, then the later value for that key will overwrite the previous one.
     * If, however, the arrays contain numeric keys, the later value will not overwrite the original value but will
     * be appended.
     * Values in the input arrays with numeric keys will be renumbered with incrementing keys starting from zero in
     * the result array.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> ...$arrays [optional] <p>
     * Variable list of arrays to merge.
     * </p>
     *
     * @return array<TKey, TValue> The resulting array.
     *
     * @note If the input arrays have the same string keys, then the later value for that key will overwrite the
     * previous one.
     * @note If the arrays contain numeric keys, the later value will be appended.
     * @note Numeric keys will be renumbered.
     */
    public static function merge (array ...$arrays):array {

        return array_merge(...$arrays);

    }

    /**
     * ### Merge two or more arrays recursively
     *
     * Merges the elements of one or more arrays so that the values of one are appended to the end of the
     * previous one.
     * It returns the resulting array.
     * If the input arrays have the same string keys, then the values for these keys are merged into an array.
     * This is done recursively, so that if one of the values is an array itself, the function will merge it with a
     * corresponding entry in another array too.
     * If, however, the arrays have the same numeric key, the later value will not overwrite the original value but
     * will be appended.
     * @since 1.0.0
     *
     * @param array<array-key, mixed> ...$arrays [optional] <p>
     * Variable list of arrays to recursively merge.
     * </p>
     *
     * @return array<array-key, mixed> The resulting array.
     */
    public static function mergeRecursive (array ...$arrays):array {

        return array_merge_recursive(...$arrays);

    }

    /**
     * ### Pad array to the specified length with a value
     *
     * Returns a copy of the array padded to the size specified by $length with $value.
     * If the length is positive, then the array is padded on the right if it is negative, then on the left.
     * If the absolute value of length is less than or equal to the length of the array, then no padding takes place.
     * It is possible to add at most 1,048,576 elements at a time.
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $array <p>
     * Initial array of values to pad.
     * </p>
     * @param int $length <p>
     * New size of the array.
     * If the length is positive, then the array is padded on the right if it is negative, then on the left.
     * If the absolute value of length is less than or equal to the length of the array, then no padding takes place.
     * </p>
     * @param mixed $value <p>
     * Value to pad if input is less than length.
     * </p>
     *
     * @return array<array-key, mixed> A copy of the input padded to size specified by $length with value $value.
     *
     * @caution Keys can be re-numbered.
     */
    public static function pad (array $array, int $length, mixed $value):array {

        return array_pad($array, $length, $value);

    }

    /**
     * ### Replaces elements from passed arrays into the first array
     *
     * Replaces the values of $array with values having the same keys in each of the following arrays.
     * If a key from the first array exists in the second array, its value will be replaced by the value from the
     * second array.
     * If the key exists in the second array, and not the first, it will be created in the first array.
     * If a key only exists in the first array, it will be left as is.
     * If several arrays are passed for replacement, they will be processed in order, the later arrays overwriting
     * the previous values.
     * Method is not recursive, it will replace values in the first array by whatever type is in the second array.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<TValue> $array <p>
     * The array in which elements are replaced.
     * </p>
     * @param array<TValue> ...$replacements<p>
     * Arrays from which elements will be extracted.
     * Values from later arrays overwrite the previous values.
     * </p>
     *
     * @return array<TValue> The resulting array.
     */
    public static function replace (array $array, array ...$replacements):array {

        return array_replace($array, ...$replacements);

    }

    /**
     * ### Replace two or more arrays recursively
     *
     * Replaces the values of $array with the same values from all the following arrays.
     * If a key from the first array exists in the second array, its value will be replaced by the value from the
     * second array.
     * If the key exists in the second array, and not the first, it will be created in the first array.
     * If a key only exists in the first array, it will be left as is.
     * If several arrays are passed for replacement, they will be processed in order, the later array overwriting the
     * previous values.
     * When the value in the first array is scalar, it will be replaced by the value in the second array, may it be
     * scalar or array.
     * When the value in the first array and the second array are both arrays, [[Arr#replaceRecursive()]] will
     * replace their respective values recursively.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<TValue> $array <p>
     * The array in which elements are replaced.
     * </p>
     * @param array<TValue> ...$replacements<p>
     * Arrays from which elements will be extracted.
     * Values from later arrays overwrite the previous values.
     * </p>

     * @return array<TValue> The resulting array.
     */
    public static function replaceRecursive (array $array, array ...$replacements):array {

        return array_replace_recursive($array, ...$replacements);

    }

    /**
     * ### Reverse the order of array items
     *
     * Takes an input array and returns a new array with the order of the elements reversed.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * Array to reverse.
     * </p>
     * @param bool $preserve_keys [optional] <p>
     * Whether you want to preserve keys from an original array or not.
     * Non-numeric keys aren't affected by this setting and will always be preserved.
     * </p>
     *
     * @return ($preserve_keys is true ? array<TKey, TValue> : array<array-key, TValue>) The reversed array.
     */
    public static function reverse (array $array, bool $preserve_keys = false):array {

        return array_reverse($array, $preserve_keys);

    }

    /**
     * ### Extract a slice of the array
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The input array.
     * </p>
     * @param int $offset <p>
     * If the offset is non-negative, the sequence will start at that offset in the array.
     * If the offset is negative, the sequence will start that far from the end of the array.
     * </p>
     * @param null|int $length [optional] <p>
     * If length is given and is positive, then the sequence will have that many elements in it.
     * If length is given and is negative, then the sequence will stop that many elements from the end of the array.
     * If it is omitted, then the sequence will have everything from offset up until the end of the array.
     * </p>
     * @param bool $preserve_keys [optional] <p>
     * Note that array_slice will reorder and reset the array indices by default.
     * You can change this behavior by setting preserve_keys to true.
     * </p>
     *
     * @return ($preserve_keys is true ? array<TKey, TValue> : array<TKey|int, TValue>) Sliced array.
     *
     * @note Named keys will always retain their name.
     */
    public static function slice (array $array, int $offset, ?int $length = null, bool $preserve_keys = false):array {

        return array_slice($array, $offset, $length, $preserve_keys);

    }

    /**
     * ### Remove a portion of the array and replace it with something else
     *
     * Removes the elements designated by offset and length from the array $array, and replaces them with the elements
     * of the replacement array, if supplied.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * Array to splice.
     * </p>
     * @param int $offset <p>
     * If the offset is positive, then the start of the removed portion is at that offset from the beginning of the
     * input array.
     * If the offset is negative, then it starts that far from the end of the input array.
     * </p>
     * @param null|int $length [optional] <p>
     * If the length is omitted, removes everything from offset to the end of the array.
     * If the length is specified and is positive, then that many elements will be removed.
     * If the length is specified and is negative, then the end of the removed portion will be that many elements from
     * the end of the array.
     * </p>
     * @param mixed $replacement [optional] <p>
     * If a replacement array is specified, then the removed elements will be replaced with elements from this array.
     * If offset and length are such that nothing is removed, then the elements from the replacement array or array
     * are inserted in the place specified by the offset.
     * Keys in a replacement array aren't preserved.
     * </p>
     * @phpstan-param-out array<TKey, mixed> $array
     *
     * @return array<TKey, TValue> Spliced array.
     *
     * @note Numerical keys in an array aren't preserved.
     * @note If the replacement is not an array, it will be typecast to one (in other words (array) $replacement).
     * This may result in unexpected behavior when using an object or null replacement.
     */
    public static function splice (array &$array, int $offset, ?int $length = null, mixed $replacement = []):array {

        return array_splice($array, $offset, $length, $replacement);

    }

    /**
     * ### Removes duplicate values from an array
     *
     * Takes an input array and returns a new array without duplicate values.
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array to remove duplicates.
     * </p>
     *
     * @return array<TKey, TValue> The filtered array.
     *
     * @note The new array will preserve keys.
     * @note This method is not intended to work on multidimensional arrays.
     */
    public static function unique (array $array):array {

        return array_unique($array, SORT_REGULAR);

    }

    /**
     * ### Create an array containing a range of elements
     * @since 1.0.0
     *
     * @param int|float|string $start <p>
     * First value of the sequence.
     * </p>
     * @param int|float|string $end <p>
     * The sequence is ended upon reaching the end value.
     * </p>
     * @param positive-int|float $step [optional] <p>
     * If a step value is given, it will be used as the increment between elements in the sequence.
     * Step should be given as a positive number. If not specified, a step will default to 1.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException If $step is 0, $start, $end, or $step is not
     * finite, or $step is negative, but the produced range is increasing (in other words, $start <= $end).
     *
     * @return array<int, int|float|string> An array of elements from start to end, inclusive, false otherwise.
     *
     * @note Character sequence values are limited to a length of one. If a length greater than one is entered.
     * only the first character is used.
     */
    public static function range (int|float|string $start, int|float|string $end, int|float $step = 1):array {

        try {

            return range($start, $end, $step);

        } catch (ValueError $error) {

            throw new OutOfRangeException()->withMessage($error->getMessage());

        }

    }

    /**
     * ### Pick one or more random keys out of an array
     *
     * Picks one or more random entries out of an array and returns the key (or keys) of the random entries.
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $array <p>
     * The input array.
     * </p>
     * @param positive-int $number [optional] <p>
     * Specifies how many entries should be picked.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException if $array is empty, or if $number is out of
     * range.
     *
     * @return array<int, array-key>|int|string When picking only one entry, [[Arr#random()]] returns the key for
     * a random entry.
     * Otherwise, an array of keys for the random entries is returned.
     *
     * @caution This function doesn't generate cryptographically secure values and mustn't be used for cryptographic
     * purposes, or purposes that require returned values to be unguessable.
     */
    public static function random (array $array, int $number = 1):int|string|array {

        try {

            return array_rand($array, $number);

        } catch (ValueError $error) {

            throw new OutOfRangeException()->withMessage($error->getMessage());

        }

    }

    /**
     * ### Iteratively reduce the array to a single value using a callback function
     *
     * Iteratively applies the $callback function to the elements of the $array, to reduce the array to a single value.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<array-key, TValue> $array <p>
     * The input array.
     * </p>
     * @param callable(mixed, TValue):mixed $callback <p>
     * The callable function.
     * </p>
     * @param mixed $initial [optional] <p>
     * If the optional initial is available, it will be used at the beginning of the process, or as a final result in
     * case the array is empty.
     * </p>
     *
     * @return mixed Resulting value or null if the array is empty and the initial is not passed.
     */
    public static function reduce (array $array, callable $callback, mixed $initial = null):mixed {

        return array_reduce($array, $callback, $initial);

    }

    /**
     * ### Pop the element off the end of an array
     *
     * Pops and returns the last element value of th $array, shortening the $array by one element.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<array-key, TValue> &$array <p>
     * The array to get the value from.
     * </p>
     * @phpstan-param-out array<array-key, TValue> $array
     *
     * @return TValue|null The last value of an array. If an array is empty (or is not an array), null will be returned.
     *
     * @note This function will reset the array pointer of the input array after use.
     */
    public static function pop (array &$array):mixed {

        return array_pop($array);

    }

    /**
     * ### Push elements onto the end of an array
     *
     * Method treats an array as a stack and pushes the passed variables onto the end of an array.
     * The length of an array increases by the number of variables pushed.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<array-key, TValue> &$array <p>
     * The input array.
     * </p>
     * @param TValue ...$values [optional] <p>
     * The values to push onto the end of the array.
     * </p>
     * @phpstan-param-out array<array-key, TValue> $array
     *
     * @return int The new number of elements in the array.
     *
     * @note If you use push to add one element to the array, it is better to use $array[] = because in that way there
     * is no overhead of calling a function.
     */
    public static function push (array &$array, mixed ...$values):int {

        return array_push($array, ...$values);

    }

    /**
     * ### Removes an item at the beginning of an array
     *
     * Shifts the first value of the array off and returns it, shortening the array by one element and moving
     * everything down.
     * All numerical array keys will be modified to start counting from zero while literal keys won't be affected.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<array-key, TValue> &$array <p>
     * Array to shift.
     * </p>
     * @phpstan-param-out array<array-key, TValue> $array
     *
     * @return TValue|null The shifted value, or null if an array is empty or is not an array.
     *
     * @note This function will reset the array pointer of the input array after use.
     */
    public static function shift (array &$array):mixed {

        return array_shift($array);

    }

    /**
     * ### Prepend one or more elements to the beginning of an array
     *
     * Method prepends passed elements to the front of the array.
     * Note that the list of elements is prepended as a whole so that the prepended elements stay in the same order.
     * All numerical array keys will be modified to start counting from zero while literal keys won't be changed.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<array-key, TValue> &$array <p>
     * The input array.
     * </p>
     * @param TValue ...$values [optional] <p>
     * The values to prepend.
     * </p>
     * @phpstan-param-out array<array-key, TValue> $array
     *
     * @return int The new number of elements in the array.
     *
     * @note Resets array's internal pointer to the first element.
     */
    public static function unshift (array &$array, mixed ...$values):int {

        return array_unshift($array, ...$values);

    }

    /**
     * ### Get the first key from an array
     *
     * Get the first key of the given $array without affecting the internal array pointer.
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $array <p>
     * An array.
     * </p>
     *
     * @return null|int|string First key from $array or null if an array is empty.
     */
    public static function firstKey (array $array):null|int|string {

        return array_key_first($array);

    }

    /**
     * ### Get the last key from an array
     *
     * Get the last key of the given $array without affecting the internal array pointer.
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $array <p>
     * An array.
     * </p>
     *
     * @return null|int|string Last key from $array or null if an array is empty.
     */
    public static function lastKey (array $array):null|int|string {

        return array_key_last($array);

    }

    /**
     * ### Calculate the product of values in an array
     *
     * Returns the product of values in an array.
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $array <p>
     * The array.
     * </p>
     *
     * @return int|float The product as an integer or float.
     */
    public static function product (array $array):int|float {

        return array_product($array);

    }

    /**
     * ### Calculate the sum of values in an array
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $array <p>
     * The input array.
     * </p>
     *
     * @return int|float The sum of values as an integer or float; 0 if the array is empty.
     */
    public static function sum (array $array):int|float {

        return array_sum($array);

    }

    /**
     * ### Searches the array for a given value and returns the first corresponding key if successful
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param mixed $value <p>
     * The searched value.
     * If $value is a string, the comparison is done in a case-sensitive manner.
     * </p>
     * @param array<TKey, TValue> $array <p>
     * Array to search.
     * </p>
     *
     * @return TKey|false The key for value if it is found in the array, false otherwise.
     *
     * @warning This method may return Boolean false but may also return a non-Boolean value which evaluates to false.
     * Read the section on Booleans for more information.
     * Use the === operator for testing the return value of this function.
     */
    public static function search (mixed $value, array $array):int|string|false {

        return array_search($value, $array, true);

    }

    /**
     * ### Returns the first element satisfying a callback function
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array that should be searched.
     * </p>
     * @param callable(TValue, TKey=):mixed $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|TValue The value of the first element for which the callback returns true, null otherwise.
     */
    public static function find (array $array, callable $callback):mixed {

        return array_find($array, $callback); // @phpstan-ignore argument.type

    }

    /**
     * ### Returns the key of the first element satisfying a callback function
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> $array <p>
     * The array that should be searched.
     * </p>
     * @param callable(TValue, TKey=):mixed $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|TValue The key of the first element for which the callback returns true, null otherwise.
     */
    public static function findKey (array $array, callable $callback):mixed {

        return array_find_key($array, $callback); // @phpstan-ignore argument.type, return.type

    }

    /**
     * ### Shuffle array
     *
     * This function shuffles (randomizes the order of the elements in) an array.
     * @since 1.0.0
     *
     * @template TValue
     *
     * @param array<array-key, TValue> &$array <p>
     * The array.
     * </p>
     * @phpstan-param-out array<array-key, TValue> $array
     *
     * @return true Always returns true.
     *
     * @caution This function doesn't generate cryptographically secure values and mustn't be used for cryptographic
     * purposes, or purposes that require returned values to be unguessable.
     * @note This function assigns new keys to the elements in an array.
     * It will remove any existing keys that may have been assigned, rather than reordering the keys.
     * @note Resets array's internal pointer to the first element.
     */
    public static function shuffle (array &$array):true {

        return shuffle($array);

    }

    /**
     * ### Sorts array
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Order::ASC As default parameter.
     * @uses \FireHub\Core\Support\Enums\Sort::BY_REGULAR As default parameter.
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * Array to sort.
     * </p>
     * @param \FireHub\Core\Support\Enums\Order $order [optional] <p>
     * Order type.
     * </p>
     * @param \FireHub\Core\Support\Enums\Sort $flag [optional] <p>
     * Sort flag.
     * </p>
     * @param bool $preserve_keys [optional] <p>
     * Whether you want to preserve keys from an original array or not.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return true Always true.
     *
     * @note Resets array's internal pointer to the first element.
     */
    public static function sort (array &$array, Order $order = Order::ASC, Sort $flag = Sort::BY_REGULAR, bool $preserve_keys = false):true {

        return $order === Order::ASC
            ? ($preserve_keys
                ? asort($array, $flag->value)
                : sort($array, $flag->value))
            : ($preserve_keys
                ? arsort($array, $flag->value)
                : rsort($array, $flag->value));

    }

    /**
     * ### Sorts an array by key
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Order::ASC As default parameter.
     * @uses \FireHub\Core\Support\Enums\Sort::BY_REGULAR As default parameter.
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * Array to sort.
     * </p>
     * @param \FireHub\Core\Support\Enums\Order $order [optional] <p>
     * Order type.
     * </p>
     * @param \FireHub\Core\Support\Enums\Sort $flag [optional] <p>
     * Sort flag.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return true Always true.
     *
     * @note Resets array's internal pointer to the first element.
     */
    public static function sortByKeys (array &$array, Order $order = Order::ASC, Sort $flag = Sort::BY_REGULAR):true {

        return $order === Order::ASC
            ? ksort($array, $flag->value)
            : krsort($array, $flag->value);

    }

    /**
     * ### Sorts an array by values using a user-defined comparison function
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * Array to sort.
     * </p>
     * @param callable(TValue, TValue):int<-1, 1> $callback <p>
     * The comparison function must return an integer less than, equal to, or greater than zero if the first argument
     * is considered to be respectively less than, equal to, or greater than the second.
     * </p>
     * @param bool $preserve_keys [optional] <p>
     * Whether you want to preserve keys from an original array or not.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return true Always true.
     *
     * @caution Returning non-integer values from the comparison function, such as float, will result in an internal
     * cast to int of the callback's return value.
     * So values such as 0.99 and 0.1 will both be cast to an integer value of 0, which will compare such values as
     * equal.
     */
    public static function sortBy (array &$array, callable $callback, bool $preserve_keys = false):true {

        return $preserve_keys
            ? uasort($array, $callback)
            : usort($array, $callback);

    }

    /**
     * ### Sorts an array by key using a user-defined comparison function
     * @since 1.0.0
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param array<TKey, TValue> &$array <p>
     * Array to sort.
     * </p>
     * @param callable(TKey, TKey):int<-1, 1> $callback <p>
     * The callback comparison function.
     * Function cmp_function should accept two parameters which will be filled by pairs of array keys.
     * The comparison function must return an integer less than, equal to, or greater than zero if the first argument
     * is considered to be respectively less than, equal to, or greater than the second.
     * </p>
     * @phpstan-param-out array<TKey, TValue> $array
     *
     * @return true Always true.
     *
     * @note Resets array's internal pointer to the first element.
     */
    public static function sortKeysBy (array &$array, callable $callback):true {

        return uksort($array, $callback);

    }

}
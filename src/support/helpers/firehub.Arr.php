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

namespace FireHub\Core\Support\Helpers\Arr;

use FireHub\Core\Support\Exceptions\Arr\ArrayItemMissingKeyException;
use FireHub\Core\Support\Enums\Order;
use FireHub\Core\Support\LowLevel\ {
    Arr, DataIs, Iterables
};

/**
 * ### Checks if an array is empty
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count array elements.
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Arr\isEmpty;
 *
 * isEmpty([]);
 *
 * // true
 * ```
 *
 * @param array<array-key, mixed> $array <p>
 * Array to check.
 * </p>
 *
 * @return bool True if an array is empty, false otherwise
 *
 * @api
 */
function isEmpty (array $array):bool {

    return Iterables::count($array) === 0;

}

/**
 * ### Get first value from array
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Arr::firstKey() To get the first key from an array.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Arr\first;
 *
 * first([1,2,3]);
 *
 * // 1
 * ```
 *
 * @param array<TKey, TValue> $array <p>
 * The array.
 * </p>
 *
 * @return null|TValue First value from an array or null if an array is empty.
 *
 * @api
 */
function first (array $array):mixed {

    $key = Arr::firstKey($array);

    return isset($key) ? $array[$key] : null;

}

/**
 * ### Get last value from array
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Arr::lastKey() To get the last key from an array.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Arr\last;
 *
 * last([1,2,3]);
 *
 * // 3
 * ```
 *
 * @param array<TKey, TValue> $array <p>
 * The array.
 * </p>
 *
 * @return null|TValue Last value from array or null if an array is empty.
 *
 * @api
 */
function last (array $array):mixed {

    $key = Arr::lastKey($array);

    return isset($key) ? $array[$key] : null;

}

/**
 * ### Cross join provided arrays
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Arr::lastKey() To get the last key from an array.
 *
 * @template TValue
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Arr\crossJoin;
 *
 * last([1,2,3]);
 *
 * // 3
 * ```
 *
 * @param array<array-key, TValue> ...$arrays <p>
 * Arrays to cross join.
 * </p>
 *
 * @return list<array<TValue>> Cross joined arrays.
 *
 * @api
 */
function crossJoin (array ...$arrays):array {

    $data = [[]];

    foreach ($arrays as $index => $value) {

        $result = [];
        foreach ($data as $product)
            foreach ($value as $item) {

                $product[$index] = $item;

                $result[] = $product;

            }

        $data = $result;

    }

    return $data;

}

/**
 * ### Pick one or more random values out of the array
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Arr::random() To pick one or more random keys out of an array.
 * @uses \FireHub\Core\Support\LowLevel\DataIs::array() To check if the value is an array.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Arr\random;
 *
 * random([1, 1, 1, 1, 2, 3, 3, 3, 4, 4, 5], 1);
 *
 * // 4
 * ```
 *
 * @param array<TKey, TValue> $array <p>
 * Array from we're picking random items.
 * </p>
 * @param positive-int $number [optional] <p>
 * Specifies how many entries you want to pick.
 * </p>
 * @param bool $preserve_keys [optional] <p>
 * Whether you want to preserve keys from an original array or not.
 * </p>
 *
 * @throws \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException If an array is empty, or if the number
 * is out of range.
 *
 * @return ($preserve_keys is true ? ($number is 1 ? TValue : array<TKey, TValue>) : ( $number is 1 ? TValue : list<TValue>))
 * If you're picking only one entry, return the value for a random entry.
 * Otherwise, it returns an array of values for the random entries.
 *
 * @api
 *
 * @SuppressWarnings("PHPMD.BooleanArgumentFlag")
 */
function random (array $array, int $number = 1, bool $preserve_keys = false):mixed {

    $keys = Arr::random($array, $number);

    if (!DataIs::array($keys)) return $array[$keys];

    $items = [];
    foreach ($keys as $key)
        $preserve_keys ? $items[$key] = $array[$key] : $items[] = $array[$key];

    return $items; // @phpstan-ignore return.type

}

/**
 * ### Shuffle array items with keys preserved
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Arr::keys() To get array keys.
 * @uses \FireHub\Core\Support\LowLevel\Arr::shuffle() To shuffle array items.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Arr\shuffle;
 *
 * shuffle(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
 *
 * // ['age' => 25, 'firstname' => 'John', 'lastname' => 'Doe', 10 => 2]
 * ```
 *
 * @param array<TKey, TValue> &$array <p>
 * An array to shuffle.
 * </p>
 *
 * @return true Always returns true.
 *
 * @api
 */
function shuffle (array &$array):true {

    $items = [];

    $keys = Arr::keys($array);

    Arr::shuffle($keys);

    foreach($keys as $key) $items[$key] = $array[$key];

    $array = $items;

    return true;

}

/**
 * ### Group two-dimensional array by provided unique and duplicated column values
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Arr::inArray() To check if a value exists in an array.
 *
 * @template TKey of array-key
 * @template TValue of array<array-key, mixed>
 *
 * @example
 * ```php
 * use function FireHub\Core\Support\Helpers\Arr\uniqueDuplicatesTwoDimensional;
 *
 * uniqueDuplicatesTwoDimensional([
 *  1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
 *  2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
 *  3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
 *  4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
 *  5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
 * ], 'lastname');
 *
 * // [
 * //   1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
 *      3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25]
 * // ],
 * // [
 * //   2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
 * //   4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
 * //   5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
 * // ]
 * ```
 *
 * @param array<TKey, TValue> $array <p>
 * The array.
 * </p>
 * @param key-of<TValue> $key <p>
 * Array key to group with.
 * </p>
 *
 * @throws \FireHub\Core\Support\Exceptions\Arr\ArrayItemMissingKeyException If any of the items doesn't have
 * a provided key.
 *
 * @return array<'unique'|'duplicates', array<TKey, TValue>> The grouped array with unique and duplicated values.
 *
 * @api
 */
function uniqueDuplicatesTwoDimensional (array $array, mixed $key):array {

    $keys = [];
    $unique = [];
    $duplicates = [];

    foreach ($array as $array_key => $array_value) {

        if (!isset($array_value[$key])) throw new ArrayItemMissingKeyException()->withKey($key);

        if (!Arr::inArray($array_value[$key], $keys)) {

            $keys[] = $array_value[$key];
            $unique[$array_key] = $array_value;

        } else $duplicates[$array_key] = $array_value;

    }

    return ['unique' => $unique, 'duplicates' => $duplicates];

}

/**
 * ### Sort multiple on two-dimensional arrays
 * @since 1.0.0
 *
 * @uses \FireHub\Core\Support\LowLevel\Arr::column() To return the values from a single column in the input array.
 * @uses \FireHub\Core\Support\LowLevel\Arr::multiSort() To sort multiple or multidimensional arrays.
 * @uses \FireHub\Core\Support\Enums\Order::DESC As order enum.
 *
 * @template TArray of array<array-key, array<array-key, mixed>>
 *
 * @example
 * ```php
 * use FireHub\Core\Support\Enums\Order;
 * use function FireHub\Core\Support\Helpers\Arr\multiSort;
 *
 * $array = [
 *  ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'gender' => 'male', 'age' => 25],
 *  ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'gender' => 'female', 'age' => 23],
 *  ['id' => 3, 'firstname' => 'Richard', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 27],
 *  ['id' => 4, 'firstname' => 'Jane', 'lastname' => 'Roe', 'gender' => 'female', 'age' => 22],
 *  ['id' => 5, 'firstname' => 'John', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 26]
 * ];
 *
 * multiSort($array, [
 *  'lastname' => Order::ASC
 *  'age' => Order::DESC
 * ]);
 *
 * // [
 * //   ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'gender' => 'male', 'age' => 25],
 * //   ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'gender' => 'female', 'age' => 23],
 * //   ['id' => 3, 'firstname' => 'Richard', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 27],
 * //   ['id' => 5, 'firstname' => 'John', 'lastname' => 'Roe', 'gender' => 'male', 'age' => 26],
 * //   ['id' => 4, 'firstname' => 'Jane', 'lastname' => 'Roe', 'gender' => 'female', 'age' => 22]
 * // ]
 * ```
 *
 * @param TArray &$array <p>
 * A two-dimensional array being sorted.
 * </p>
 * @param array<int|string, \FireHub\Core\Support\Enums\Order|value-of<\FireHub\Core\Support\Enums\Order>> $fields <p>
 * List of fields to sort by.
 * </p>
 *
 * @throws \FireHub\Core\Support\Exceptions\Arr\FailedSortMultiArrayException Failed to sort a multi-sort array.
 * @throws \FireHub\Core\Support\Exceptions\Arr\SizeInconsistentException If array sizes are inconsistent.
 *
 * @return bool True on success, false otherwise.
 *
 * @caution Associative (string) keys will be maintained, but numeric keys will be re-indexed.
 * @note Resets array's internal pointer to the first element.
 *
 * @api
 */
function multiSort (array &$array, array $fields):bool {

    $multi_sort = [];

    foreach ($fields as $column => $order) {

        $order = match($order) {
            Order::DESC => SORT_DESC,
            default => SORT_ASC
        };

        $multi_sort[] = [...Arr::column($array, $column)];

        $multi_sort[] = $order;

    }

    $multi_sort[] = &$array;

    return Arr::multiSort($multi_sort); // @phpstan-ignore argument.type

}
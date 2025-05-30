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

use FireHub\Core\Support\LowLevel\ {
    Arr, Iterables
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
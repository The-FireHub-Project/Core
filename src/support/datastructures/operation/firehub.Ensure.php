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

namespace FireHub\Core\Support\DataStructures\Operation;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage;
use FireHub\Core\Support\LowLevel\Arr;

/**
 * ### Methods to ensure data structure satisfies
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class Ensure {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures As parameter.
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue> $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected DataStructures $data_structure
    ) {}

    /**
     * ### Verify that all items of a data structure pass a given truth test
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::all() To check all array elements satisfies a callback function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $check = new Ensure($collection)->all(fn($value, $key) => is_string($value));
     *
     * // true
     * ```
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * User-defined function.
     * </p>
     *
     * @return bool True if each item in the data structure passes a given truth test, false otherwise.
     */
    public function all (callable $callback):bool {

        if ($this->data_structure instanceof ArrStorage)
            return Arr::all($this->data_structure->toArray(), $callback); // @phpstan-ignore argument.type

        foreach ($this->data_structure as $key => $value)
            if ($callback($value, $key) === false) return false;

        return true;

    }

    /**
     * ### Verify that none of the items in a data structure pass a given truth test
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::any() To check if at least one array element satisfies a callback
     * function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $check = new Ensure($collection)->none(fn($value, $key) => is_string($value));
     *
     * // false
     * ```
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * User-defined function.
     * </p>
     *
     * @return bool True if none of the items in a data structure pass a given truth test, false otherwise.
     */
    public function none (callable $callback):bool {

        if ($this->data_structure instanceof ArrStorage)
            return !Arr::any($this->data_structure->toArray(), $callback); // @phpstan-ignore argument.type

        foreach ($this->data_structure as $key => $value)
            if ($callback($value, $key) === true) return false;

        return true;

    }

}
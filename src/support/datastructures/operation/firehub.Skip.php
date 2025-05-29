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

use FireHub\Core\Support\DataStructures\Contracts\Filterable;
use FireHub\Core\Support\DataStructures\Function\Slice;

/**
 * ### Check is operations for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\Filterable
 * @template TKey
 * @template TValue
 */
readonly class Skip {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable As parameter.
     *
     * @param TDataStructure<TKey, TValue> $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Filterable $data_structure
    ) {}

    /**
     * ### Skip first n items from data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Function\Slice To get a slice from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Skip;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $skip = new Skip($collection)->first(2);
     *
     * // ['Jane', 'Jane', 'Richard', 'Richard']
     * ```
     *
     * @param non-negative-int $number_of_items <p>
     * Number of items to skip.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function first (int $number_of_items):Filterable {

        return new Slice($this->data_structure)(max($number_of_items, 0));

    }

    /**
     * ### Skip until the given callback returns true
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Skip;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $skip = new Skip($collection)->until(function ($value) {
     *  return $value !== 'Richard';
     * });
     *
     * // ['Richard', 'Richard']
     * ```
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function until (callable $callback):Filterable {

        return $this->data_structure->filter(function ($value, $key) use ($callback, &$found) {

            if (!$found && !$callback($value, $key)) return false;

            $found = true;

            return true;

        });

    }

    /**
     * ### Skip while the given callback returns true
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Skip;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $skip = new Skip($collection)->while(function ($value) {
     *  return $value === 'John';
     * });
     *
     * // ['Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function while (callable $callback):Filterable {

        return $this->data_structure->filter(function ($value, $key) use ($callback, &$found) {

            if (!$found && $callback($value, $key)) return false;

            $found = true;

            return true;

        });

    }

}
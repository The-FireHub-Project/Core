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

use FireHub\Core\Support\DataStructures\Contracts\ {
    ArrayableStorage, Filterable
};
use FireHub\Core\Support\DataStructures\Function\Slice;
use FireHub\Core\Support\LowLevel\ {
    Arr, DataIs
};

use function FireHub\Core\Support\Helpers\Data\toString;

/**
 * ### Check is operations for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\Filterable
 * @template TKey
 * @template TValue
 */
readonly class Take {

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
     * ### Take first n items from data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Function\Slice To get a slice from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $take = new Take($collection)->first(2);
     *
     * // ['John', 'Jane']
     * ```
     *
     * @param non-negative-int $number_of_items <p>
     * Number of items to take.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function first (int $number_of_items):Filterable {

        return new Slice($this->data_structure)(0, max($number_of_items, 0));

    }

    /**
     * ### Take last n items from data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Function\Slice To get a slice from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $take = new Take($collection)->last(2);
     *
     * // ['Richard', 'Richard']
     * ```
     *
     * @param non-negative-int $number_of_items <p>
     * Number of items to take.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function last (int $number_of_items):Filterable {

        return new Slice($this->data_structure)(min(-$number_of_items, 0), max($number_of_items, 0));

    }

    /**
     * ### Take until the given callback returns true
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $take = new Take($collection)->until(function ($value) {
     *  return $value === 'Richard';
     * });
     *
     * // ['John', 'Jane', 'Jane', 'Jane']
     * ```
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function until (callable $callback):Filterable {

        return $this->data_structure->filter(fn($value, $key) => !$callback($value, $key) ?: 'break');

    }

    /**
     * ### Take while the given callback returns true
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $take = new Take($collection)->while(function ($value) {
     *  return $value !== 'Richard';
     * });
     *
     * // ['John', 'Jane', 'Jane', 'Jane']
     * ```
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function while (callable $callback):Filterable {

        return $this->data_structure->filter(fn($value, $key) => !$callback($value, $key) ? 'break' : true);

    }

    /**
     * ### Take every n-th element
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = new Take($collection)->nth(2);
     *
     * // ['John', 'Jane', 'Richard']
     * ```
     *
     * @param positive-int $step <p>
     * N-th step.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function nth (int $step):Filterable {

        return $this->data_structure->filter(function () use ($step, &$counter) {

            return ($counter++ % (max($step, 1)) === 0);

        });

    }

    /**
     * ### Take even elements
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Skip::first() Ti skip first element.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Take::nth() To get every n-th element.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = new Take($collection)->nth(2);
     *
     * // ['John', 'Jane', 'Richard']
     * ```
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function even ():Filterable {

        return new self(new Skip($this->data_structure)->first(1))->nth(2);

    }

    /**
     * ### Take odd elements
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Take::nth() To get every n-th element.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = new Take($collection)->nth(2);
     *
     * // ['John', 'Jane', 'Richard']
     * ```
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function odd ():Filterable {

        return $this->nth(2);

    }

    /**
     * ### Takes distinct values from a data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\ArrayableStorage::toArray() To get data storage as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::distinct() To remove duplicate values from an array.
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter To filter items from the data structure.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Take::valueToString() Convert value to string.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = new Take($collection)->distinct();
     *
     * // ['John', 'Jane', 'Richard']
     * ```
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function distinct ():Filterable {

        if ($this->data_structure instanceof ArrayableStorage)
            return new $this->data_structure(Arr::distinct($this->data_structure->toArray()));

        $map = [];

        return $this->data_structure->filter(function ($value) use (&$map) {


            $value = $this->valueToString($value);

            if (isset($map[$value])) return false;

            $map[$value] = true;

            return true;

        });

    }

    /**
     * ### Takes unique values from a data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::countBy() To count values from
     * the data structure.
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter To filter items from the data structure.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::get() To get the total number
     * of items.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Take::valueToString() Convert value to string.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = new Take($collection)->unique();
     *
     * // ['John']
     * ```
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function unique ():Filterable {

        $map = $this->data_structure->countBy()->values();

        return $this->data_structure->filter(fn($value) => $map->get($this->valueToString($value)) === 1);

    }

    /**
     * ### Takes duplicate values from a data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::countBy() To count values from
     * the data structure.
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter To filter items from the data structure.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::get() To get the total number
     * of items.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Take::valueToString() Convert value to string.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Take;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = new Take($collection)->duplicates();
     *
     * // ['Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function duplicates ():Filterable {

        $map = $this->data_structure->countBy()->values();

        return $this->data_structure->filter(fn($value) => $map->get($this->valueToString($value)) > 1);

    }

    /**
     * ### Convert value to string
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To find whether the array key is a string.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::int() To find whether the array key is an integer.
     * @uses \FireHub\Core\Support\Helpers\Data\toString() To convert value to string.
     *
     * @param TValue $value <p>
     * Provided value.
     * </p>
     *
     * @return array-key String from provided value.
     */
    private function valueToString (mixed $value):int|string {

        return DataIs::string($value) || DataIs::int($value)
            ? $value
            : toString($value, detailed: true);

    }

}
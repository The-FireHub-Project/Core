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
use FireHub\Core\Support\DataStructures\Contracts\Filterable;

/**
 * ### Create new data structure with keys or values that are not appearing in any of the other data structure
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\Filterable
 * @template TKey
 * @template TValue
 */
readonly class Intersect {

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
     * ### Create new data structure with keys that are not appearing in any of the other data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from data structure.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::contains() To determine whether a data structure
     * contains certain key.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::key() To determine whether a data structure
     * contains key.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * $collection2 = new Associative(['firstname' => 'John_', '_lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $diff = $collection->inKeys($collection2);
     *
     * // [''firstname' => 'John', 'age' => 25, 10 => 2]
     * ```
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue> $data_structure <p>
     * Data structure to provide set operator.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function inKeys (DataStructures $data_structure):Filterable {

        return $this->data_structure->filter(fn($value, $key) => $data_structure->contains()->key($key));

    }

    /**
     * ### Create new data structure with values that are not appearing in any of the other data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from data structure.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::contains() To determine whether a data structure
     * contains certain value.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::value() To determine whether a data structure
     * contains value.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * $collection2 = new Associative(['firstname' => 'John_', '_lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $diff = $collection->inValues($collection2);
     *
     * // ['lastname' => 'Doe', 'age' => 25, 10 => 2]
     * ```
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue> $data_structure <p>
     * Data structure to provide set operator.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function inValues (DataStructures $data_structure):Filterable {

        return $this->data_structure->filter(fn($value, $key) => $data_structure->contains()->value($value));

    }

    /**
     * ### Create new data structure with keys and values that are not appearing in any of the other data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from data structure.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::contains() To determine whether a data structure
     * contains certain value.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::pair() To determine whether a data structure
     * contains a key and value pair.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * $collection2 = new Associative(['_firstname' => 'John_', '_lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $diff = $collection->inKeyAndValuePairs($collection2);
     *
     * // ['age' => 25, 10 => 2]
     * ```
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue> $data_structure <p>
     * Data structure to provide set operator.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function inKeyAndValuePairs (DataStructures $data_structure):Filterable {

        return $this->data_structure->filter(
            fn($value, $key) => $data_structure->contains()->pair($key, $value)
        );

    }

}
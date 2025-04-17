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

namespace FireHub\Core\Support\Contracts\HighLevel;

use FireHub\Core\Support\Contracts\ {
    Countable, JsonSerializable
};
use FireHub\Core\Support\Contracts\Iterator\IteratorAggregate;
use FireHub\Core\Support\Contracts\Magic\Serializable;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, When
};

/**
 * ### Data structures
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\Iterator\IteratorAggregate<TKey, TValue>
 */
interface DataStructures extends Countable, IteratorAggregate, JsonSerializable, Serializable {

    /**
     * ### Get data structure data as an array
     * @since 1.0.0
     *
     * @return array<array-key, mixed> Data structure data as an array.
     */
    public function toArray ():array;

    /**
     * ### Count operations for data structures
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy As return.
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\CountBy<TKey, TValue> Count operation class.
     */
    public function countBy ():CountBy;

    /**
     * ### Conditionable methods for data structures
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\When As return.
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\When<$this> Count operation class.
     */
    public function when ():When;

    /**
     * ### Check if a data structure is empty
     * @since 1.0.0
     *
     * @return bool True if a data structure is empty, false otherwise.
     */
    public function isEmpty ():bool;

    /**
     * ### Check if a data structure is not empty
     * @since 1.0.0
     *
     * @return bool True if a data structure is not empty, false otherwise.
     */
    public function isNotEmpty ():bool;

    /**
     * ### Call user-generated function on each item in data structure
     * @since 1.0.0
     *
     * @param callable(TValue, TKey):void $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     * @param positive-int $limit [optional] <p>
     * Maximum number of elements that is allowed to be iterated.
     * </p>
     *
     * @return $this
     */
    public function each (callable $callback, int $limit = 1_000_000):self;

    /**
     * ### Verify that all items of a data structure pass a given truth test
     * @since 1.0.0
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     * @param positive-int $limit [optional] <p>
     * Maximum number of elements that is allowed to be iterated.
     * </p>
     *
     * @return bool True if each item in the data structure passes a given truth test, false otherwise.
     */
    public function all (callable $callback, int $limit = 1_000_000):bool;

    /**
     * ### Verify that any item of a data structure pass a given truth test
     * @since 1.0.0
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     * @param positive-int $limit [optional] <p>
     * Maximum number of elements that is allowed to be iterated.
     * </p>
     *
     * @return bool True if any item in the data structure passes a given truth test, false otherwise.
     */
    public function any (callable $callback, int $limit = 1_000_000):bool;

}
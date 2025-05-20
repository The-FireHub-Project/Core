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
    Arrayable, Countable, JsonSerializable
};
use FireHub\Core\Support\Contracts\Iterator\IteratorAggregate;
use FireHub\Core\Support\Contracts\Magic\Serializable;
use FireHub\Core\Support\DataStructures\Operation\CountBy;

use const FireHub\Core\Support\Constants\Number\MAX;

/**
 * ### Data structures
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\Iterator\IteratorAggregate<TKey, TValue>
 */
interface DataStructures extends Arrayable, Countable, IteratorAggregate, JsonSerializable, Serializable {

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
     * ### Call a user-generated function on each item in the data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Number\MAX As default limit.
     *
     * @param callable(TValue, TKey):void $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     * @param positive-int $limit [optional] <p>
     * Maximum number of elements that is allowed to be iterated.
     * </p>
     *
     * @return $this This data structure.
     */
    public function each (callable $callback, int $limit = MAX):static;

    /**
     * ### Applies the callback to the elements of the data structure
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):mixed $callback <p>
     * A callable to run for each element in a data structure.
     * </p>
     *
     * @return $this This data structure with applied callback function to the corresponding values of a data structure.
     */
    public function transform (callable $callback):self;

    /**
     * ### Creates new data stacktrace with applied callback to the elements of the data structure
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):mixed $callback <p>
     * A callable to run for each element in a data structure.
     * </p>
     *
     * @return static<TKey, TValue> New data structure containing the results of applying the callback function to
     * the corresponding values of a data structure.
     */
    public function apply (callable $callback):static;

}
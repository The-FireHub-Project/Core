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
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, Contains, Ensure, Find, Is
};

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
     * ### Create data structure from provided parameter
     * @since 1.0.0
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<covariant TKey, covariant TValue> $data_structure <p>
     * Data structure to use for creating new data structure.
     * </p>
     *
     * @return static<TKey, TValue> New data structure from provided parameter.
     */
    public static function fromDataStructure (DataStructures $data_structure):static;

    /**
     * ### Count operations for data structures
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy As return.
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\CountBy<$this> Count operation class.
     */
    public function countBy ():CountBy;

    /**
     * ### Determines whether a data structure contains
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains As return.
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\Contains<$this> Contains operation class.
     */
    public function contains ():Contains;

    /**
     * ### Ensure that satisfies in the data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Ensure As return.
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\Ensure<$this> Ensure operation class.
     */
    public function ensure ():Ensure;

    /**
     * ### Find in the data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Find As return.
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\Find<$this> Find operation class.
     */
    public function find ():Find;

    /**
     * ### Check is data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Is As return.
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\Is<$this> Check is operation class.
     */
    public function is ():Is;

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
     * @param callable(TValue, TKey):TValue $callback <p>
     * A callable to run for each element in a data structure.
     * </p>
     *
     * @return $this This data structure with applied callback function to the corresponding values of a data structure.
     */
    public function transform (callable $callback):self;

    /**
     * ### Creates a new data structure with applied callback to the elements of the data structure
     * @since 1.0.0
     *
     * @param callable(TValue, TKey):TValue $callback <p>
     * A callable to run for each element in a data structure.
     * </p>
     *
     * @return static<TKey, TValue> New data structure containing the results of applying the callback function to
     * the corresponding values of a data structure.
     */
    public function apply (callable $callback):static;

    /**
     * ### Execute the given callback when the first argument given to the method evaluates to true
     * @since 1.0.0
     *
     * @param bool $condition <p>
     * Condition to meet.
     * </p>
     * @param callable($this):mixed $condition_meet <p>
     * Callback if the condition is met.
     * </p>
     * @param null|callable($this):mixed $condition_not_meet [optional] <p>
     * Callback if the condition is not met.
     * </p>
     *
     * @return $this This data structure.
     */
    public function when (bool $condition, callable $condition_meet, ?callable $condition_not_meet = null):self;

    /**
     * ### Execute the given callback unless the first argument given to the method evaluates to true
     * @since 1.0.0
     *
     * @param bool $condition <p>
     * Condition to meet.
     * </p>
     * @param callable($this):mixed $condition_meet <p>
     * Callback if the condition is met.
     * </p>
     * @param null|callable($this):mixed $condition_not_meet [optional] <p>
     * Callback if the condition is not met.
     * </p>
     *
     * @return $this This data structure.
     */
    public function unless (bool $condition, callable $condition_meet, ?callable $condition_not_meet = null):self;

}
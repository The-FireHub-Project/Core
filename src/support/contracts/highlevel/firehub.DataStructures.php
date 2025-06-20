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
    CountBy, Contains
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

}
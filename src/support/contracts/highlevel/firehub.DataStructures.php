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

use FireHub\Core\Support\Contracts\Countable;
use FireHub\Core\Support\Contracts\Iterator\IteratorAggregate;
use FireHub\Core\Support\DataStructures\Operation\CountBy;

/**
 * ### Data structures
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\Iterator\IteratorAggregate<TKey, TValue>
 */
interface DataStructures extends Countable, IteratorAggregate {

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

}
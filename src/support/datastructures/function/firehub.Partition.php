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

namespace FireHub\Core\Support\DataStructures\Function;

use FireHub\Core\Support\DataStructures\Contracts\Filterable;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;

/**
 * ### Separate data structure items that pass a given truth test from those that do not
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class Partition {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable As parameter.
     *
     * @param \FireHub\Core\Support\DataStructures\Contracts\Filterable<TKey, TValue> $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Filterable $data_structure
    ) {}

    /**
     * ### Call an object as a function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy As return.
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter true values.
     * @uses \FireHub\Core\Support\DataStructures\Function\Reject To reject true values.
     *
     * @param callable(TValue=, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy<int, \FireHub\Core\Support\DataStructures\Contracts\Filterable<TKey, TValue>>
     * New partitioned data structure.
     */
    public function __invoke (callable $callback):Lazy {

        return new Lazy(function () use ($callback) {

            yield $this->data_structure->filter($callback);

            yield new Reject($this->data_structure)($callback);

        });

    }

}
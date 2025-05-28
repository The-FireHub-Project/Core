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

/**
 * ### Reject items from data structure
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\Filterable
 * @template TKey
 * @template TValue
 */
readonly class Reject {

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
     * ### Call an object as a function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter() To filter items from the data structure.
     *
     * @param callable(TValue=, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New filtered data structure.
     */
    public function __invoke (callable $callback):Filterable {

        return $this->data_structure->filter(fn($value) => !$callback($value)); // @phpstan-ignore argument.type

    }

}
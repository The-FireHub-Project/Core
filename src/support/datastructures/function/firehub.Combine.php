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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
use FireHub\Core\Support\LowLevel\Arr;

/**
 * ### Combines the values of the data structure, as keys, with the values of another data structure
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class Combine {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Chunkable As parameter.
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue> $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected DataStructures $data_structure
    ) {}

    /**
     * ### Call an object as a function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::combine() To create an array by using one array for keys and
     * another for its values.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::values() To get values from the data structure.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::toArray() To convert data structure to array.
     *
     * @template TCombinedValue
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<mixed, TCombinedValue> $data_structure <p>
     * Data structure to be used for values.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\KeysAndValuesDiffNumberOfElemsException If arguments $keys and
     * $values don't have the same number of elements.
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<TValue, TCombinedValue>
     * New combined data structure.
     *
     * @phpstan-ignore generics.notSubtype
     */
    public function __invoke (DataStructures $data_structure):Associative {

        return new Associative(
            Arr::combine( // @phpstan-ignore argument.templateType
                $this->data_structure->values()->toArray(), // @phpstan-ignore argument.type
                $data_structure->values()->toArray()
            )
        );

    }

}
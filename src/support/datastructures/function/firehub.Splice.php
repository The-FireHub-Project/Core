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

use FireHub\Core\Support\DataStructures\Contracts\ {
    ArrayableStorage, Filterable, Sequantionable
};
use FireHub\Core\Support\DataStructures\Helpers\SequenceRange;
use FireHub\Core\Support\LowLevel\Arr;

/**
 * ### Remove a portion of a data structure
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\Filterable
 * @template TKey
 * @template TValue
 */
readonly class Splice {

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
     * @uses \FireHub\Core\Support\DataStructures\Contracts\ArrayableStorage::toArray() To get data storage as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::splice() To remove a portion of the array.
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Filterable::filter To filter items from the data structure.
     *
     * @param int $offset <p>
     * If the offset is non-negative, the sequence will start at that offset of the data structure.
     * If the offset is negative, the sequence will start that far from the end of the data structure.
     * </p>
     * @param null|int $length [optional] <p>
     * If length is given and is positive, then the sequence will have that many elements in it.
     * If length is given and is negative, then the sequence will stop that many elements from the end of the
     * data structure.
     * If it is omitted, then the sequence will have everything from offset up until the end of the data structure.
     * </p>
     *
     * @return TDataStructure<TKey, TValue> New spliced data structure.
     */
    public function __invoke (int $offset, ?int $length = null):Filterable {

        if ($this->data_structure instanceof ArrayableStorage && $this->data_structure instanceof Sequantionable) {

            $array = $this->data_structure->toArray();
            Arr::splice($array, $offset, $length);

            return new $this->data_structure($array);

        }

        $range = new SequenceRange($this->data_structure, $offset, $length);
        $start = $range->start();
        $end = $range->end();
        $position = 0;

        return $this->data_structure->filter(function () use ($start, $end, &$position) {

            return !($position++ >= $start && $position <= $end);

        });

    }

}
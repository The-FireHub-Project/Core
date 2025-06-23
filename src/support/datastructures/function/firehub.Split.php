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
    Chunkable, Filterable
};
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\LowLevel\NumInt;

/**
 * ### Split the collection into the given number of groups filling non-terminal groups first
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\Chunkable&\FireHub\Core\Support\DataStructures\Contracts\Filterable
 */
readonly class Split {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Chunkable As parameter.
     *
     * @param TDataStructure $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Chunkable&Filterable $data_structure
    ) {}

    /**
     * ### Call an object as a function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy As return.
     * @uses \FireHub\Core\Support\LowLevel\NumInt::floor() To round group size down.
     * @uses \FireHub\Core\Support\LowLevel\NumInt::divide() To divide the total number of elements with number
     * of groups.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::count() To get total number of elements.
     *
     * @param positive-int $number_of_groups <p>
     * Number of groups.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy<int, \FireHub\Core\Support\DataStructures\Contracts\Filterable<key-of<TDataStructure>, value-of<TDataStructure>>>
     * New chunked data structure.
     */
    public function __invoke (int $number_of_groups):Lazy {

        return new Lazy(function () use ($number_of_groups) {

            $number_of_groups = max($number_of_groups, 1);

            $group_size = NumInt::floor(
                NumInt::divide($this->data_structure->count(), $number_of_groups)
            );

            $remain = $this->data_structure->count() % $number_of_groups;

            $start = 0;
            for ($position = 0; $position < $number_of_groups; $position++) {

                $size = $group_size;

                if ($position < $remain) $size++;

                if ($size) yield new Slice($this->data_structure)($start, $size);

                $start += $size;

            }

        });

    }

}
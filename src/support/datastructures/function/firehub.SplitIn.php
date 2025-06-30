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

use FireHub\Core\Support\DataStructures\Contracts\Chunkable;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\LowLevel\NumInt;

/**
 * ### Split the data structure into the given number of groups filling non-terminal groups first
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\Chunkable
 */
readonly class SplitIn {

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
        protected Chunkable $data_structure
    ) {}

    /**
     * ### Call an object as a function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy As return.
     * @uses \FireHub\Core\Support\DataStructures\Function\Chunk
     * @uses \FireHub\Core\Support\LowLevel\NumInt::ceil() To round the divider.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::count() To split the data structure into
     * the given group size filling non-terminal groups first.
     *
     * @param positive-int $number_of_groups <p>
     * Number of groups.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy<int, TDataStructure>
     * New chunked data structure.
     */
    public function __invoke (int $number_of_groups):Lazy {

        return new Chunk($this->data_structure)(
            max(NumInt::ceil($this->data_structure->count() / $number_of_groups), 1)
        );

    }

}
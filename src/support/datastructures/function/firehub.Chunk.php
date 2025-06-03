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

/**
 * ### Split the data structure into the given group size filling non-terminal groups first
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class Chunk {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Chunkable As parameter.
     *
     * @param \FireHub\Core\Support\DataStructures\Contracts\Chunkable<TKey, TValue> $data_structure <p>
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
     *
     * @param positive-int $size_of_group <p>
     * Size of each group.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy<int, \FireHub\Core\Support\DataStructures\Contracts\Chunkable<TKey, TValue>>
     * New chunked data structure.
     */
    public function __invoke (int $size_of_group):Lazy {

        $size_of_group = max($size_of_group, 1);

        $counter = 0;

        return $this->data_structure->chunkWhere(function() use (&$counter, $size_of_group) {

            $counter++;
            if ($counter === $size_of_group) {

                $counter = 0;

                return true;

            }

            return false;

        });

    }

}
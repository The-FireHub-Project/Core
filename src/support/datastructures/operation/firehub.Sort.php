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

namespace FireHub\Core\Support\DataStructures\Operation;

use FireHub\Core\Support\DataStructures\Contracts\ {
    ArrayableStorage, Sortable
};
use FireHub\Core\Support\LowLevel\Arr;

/**
 * ### Sort operations for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\DataStructures\Contracts\ArrayableStorage&\FireHub\Core\Support\DataStructures\Contracts\Sortable
 * @template TKey of array-key
 * @template TValue
 */
readonly class Sort {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Contracts\ArrayableStorage As parameter.
     * @uses \FireHub\Core\Support\DataStructures\Contracts\Sortable As parameter.
     *
     * @param TDataStructure<TKey, TValue> $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected ArrayableStorage&Sortable $data_structure
    ) {}

    /**
     * @since 1.0.0
     *
     * @return TDataStructure<TKey, TValue>
     */
    public function asc ():ArrayableStorage&Sortable {

        $storage = $this->data_structure->toArray();

        Arr::sort($storage);

        return new $this->data_structure($storage);

    }

}
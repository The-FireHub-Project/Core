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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;

/**
 * ### Check is operations for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\Contracts\HighLevel\DataStructures
 */
readonly class Is {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures As parameter.
     *
     * @param TDataStructure $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected DataStructures $data_structure
    ) {}

    /**
     * ### Check if a data structure is empty
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::count() To count elements in a data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Is;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Is($collection)->empty();
     *
     * // false
     * ```
     *
     * @return bool True if a data structure is empty, false otherwise.
     */
    public function empty ():bool {

        return $this->data_structure->count() === 0;

    }

    /**
     * ### Check if a data structure is not empty
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Is::empty() To check if the data structure is empty.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Is;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Is($collection)->notEmpty();
     *
     * // true
     * ```
     *
     * @return bool True if a data structure is not empty, false otherwise.
     */
    public function notEmpty ():bool {

        return !$this->empty();

    }

}
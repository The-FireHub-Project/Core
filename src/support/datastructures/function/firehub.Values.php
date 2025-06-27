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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
use FireHub\Core\Support\LowLevel\DataIs;

/**
 * ### Get values from the data structure
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class Values {

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
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed As return.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::null To check if the $callback parameter is passed.
     *
     * @param null|callable(TValue, TKey):bool $callback [optional] <p>
     * If specified, then only values where user function is true are returned.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed<TValue> Values from
     * the data structure.
     */
    public function __invoke (?callable $callback = null):Indexed {

        $array = [];

        if (DataIs::null($callback))
            foreach ($this->data_structure as $value) $array[] = $value;

        else foreach ($this->data_structure as $key => $value)
            if ($callback($value, $key)) $array[] = $value;

        return new Indexed($array);

    }

}
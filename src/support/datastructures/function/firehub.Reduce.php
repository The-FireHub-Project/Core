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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage;
use FireHub\Core\Support\LowLevel\Arr;

/**
 * ### Reduces the collection to a single value, passing the result of each iteration into the later iteration
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class Reduce {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear As parameter.
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear<TKey, TValue> $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Linear $data_structure
    ) {}

    /**
     * ### Call an object as a function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::reduce() To use as a reduce function.
     *
     * @param callable(mixed, TValue):mixed $callback <p>
     * The callable function.
     * </p>
     * @param mixed $initial [optional] <p>
     * If the optional initial is available, it will be used at the beginning of the process,
     * or as a final result in case the array is empty.
     * </p>
     *
     * @return mixed Invoke result.
     */
    public function __invoke (callable $callback, mixed $initial = null):mixed {

        if ($this->data_structure instanceof ArrStorage)
            return Arr::reduce($this->data_structure->toArray(), $callback, $initial); // @phpstan-ignore argument.type

        foreach ($this->data_structure as $value)
            $initial = $callback($initial, $value);

        return $initial;

    }

}
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
 * ### Conditionable methods for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\Contracts\HighLevel\DataStructures
 */
readonly class When {

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
     * ### Execute the given callback when the first argument given to the method evaluates to true
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->when()->is(true, function ($collection) {
     *  return $collection[] = 10;
     * }, function ($collection) {
     *  return $collection[] = 11;
     * });
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 10]
     * ```
     *
     * @param bool $condition <p>
     * Condition to meet.
     * </p>
     * @param callable(TDataStructure):mixed $condition_meet <p>
     * Callback if the condition is met.
     * </p>
     * @param null|callable(TDataStructure):mixed $condition_not_meet [optional] <p>
     * Callback if the condition is not met.
     * </p>
     *
     * @return TDataStructure This collection.
     */
    public function is (bool $condition, callable $condition_meet, ?callable $condition_not_meet = null):DataStructures {

        if ($condition)
            $condition_meet($this->data_structure);
        else if ($condition_not_meet !== null)
            $condition_not_meet($this->data_structure);

        return $this->data_structure;

    }

    /**
     * ### Execute the given callback unless the first argument given to the method evaluates to true
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\ReadCollectable As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->when()->unless(true, function ($collection) {
     *  return $collection[] = 10;
     * }, function (&$collection) {
     *  return $collection[] = 11;
     * });
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 11]
     * ```
     *
     * @param bool $condition <p>
     * Condition to meet.
     * </p>
     * @param callable(TDataStructure):mixed $condition_meet <p>
     * Callback if the condition is met.
     * </p>
     * @param null|callable(TDataStructure):mixed $condition_not_meet [optional] <p>
     * Callback if the condition is not met.
     * </p>
     *
     * @return TDataStructure This collection.
     */
    public function unless (bool $condition, callable $condition_meet, ?callable $condition_not_meet = null):DataStructures {

        if (!$condition)
            $condition_meet($this->data_structure);
        elseif ($condition_not_meet !== null)
            $condition_not_meet($this->data_structure);

        return $this->data_structure;

    }

}
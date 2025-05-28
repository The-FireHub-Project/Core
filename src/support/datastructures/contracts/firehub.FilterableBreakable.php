<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2024 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Support
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Support\DataStructures\Contracts;


/**
 * ### Data structure that is capable of passing through a filter with the ability to break out of the loop
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Contracts\Filterable<TKey, TValue>
 */
interface FilterableBreakable extends Filterable {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param callable(TValue=, TKey=):(bool|'break') $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     */
    public function filter (callable $callback):static;

}
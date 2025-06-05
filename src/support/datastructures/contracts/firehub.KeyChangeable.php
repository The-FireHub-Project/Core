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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;

/**
 * ### Data structure that is capable of changing its keys
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue>
 */
interface KeyChangeable extends DataStructures {

    /**
     * ### Applies the callback to the keys of the data structure
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):mixed $callback <p>
     * A callable to run for each key in a data structure.
     * </p>
     *
     * @return $this This data structure with applied callback function to the corresponding keys of a data structure.
     */
    public function transformKeys (callable $callback):self;


    /**
     * ### Creates new data structure with applied callback to the keys of the data structure
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):mixed $callback <p>
     * A callable to run for each key in a data structure.
     * </p>
     *
     * @return static<TKey, TValue> New data structure containing the results of applying the callback function to
     * the corresponding keys of a data structure.
     */
    public function applyToKeys (callable $callback):static;

}
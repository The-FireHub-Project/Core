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

namespace FireHub\Core\Support\DataStructures\Contracts;

/**
 * ### Sequence type data structure
 * @since 1.0.0
 *
 * @template TKey of int
 * @template TValue
 */
interface Listable {

    /**
     * ### Removes an item at the beginning of the data structure
     * @since 1.0.0
     *
     * @return void
     */
    public function shift ():void;

    /**
     * ### Push items at the beginning of the data collection
     * @since 1.0.0
     *
     * @param TValue $value <p>
     * Value to unshift.
     * </p>
     *
     * @return void
     */
    public function unshift (mixed $value):void;

    /**
     * ### Removes an item at the end of the data collection
     * @since 1.0.0
     *
     * @return void
     */
    public function pop ():void;

    /**
     * ### Push items at the end of the data collection
     * @since 1.0.0
     *
     * @param TValue $value <p>
     * Value to push.
     * </p>
     *
     * @return void
     */
    public function push (mixed $value):void;

}
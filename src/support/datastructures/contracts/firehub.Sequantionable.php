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
 * ### Sequantionable data structure has items in sequence order as they are created
 * @since 1.0.0
 *
 * @template TValue
 */
interface Sequantionable {

    /**
     * ### Removes an item at the beginning of the data structure
     * @since 1.0.0
     *
     * @param positive-int $items [optional] <p>
     * Number of items to remove.
     * </p>
     *
     * @return void
     */
    public function shift (int $items = 1):void;

    /**
     * ### Removes an item at the end of the data collection
     * @since 1.0.0
     *
     * @param positive-int $items [optional] <p>
     * Number of items to remove.
     * </p>
     *
     * @return void
     */
    public function pop (int $items = 1):void;

    /**
     * ### Add items at the beginning of the data collection
     * @since 1.0.0
     *
     * @param TValue ...$values <p>
     * Values to add.
     * </p>
     *
     * @return void
     */
    public function prepend (mixed ...$values):void;

    /**
     * ### Add items at the end of the data collection
     * @since 1.0.0
     *
     * @param TValue ...$values <p>
     * Values to add.
     * </p>
     *
     * @return void
     */
    public function append (mixed ...$values):void;

    /**
     * ### Get first item from data structure
     * @since 1.0.0
     *
     * @return null|TValue
     */
    public function head ():mixed;

    /**
     * ### Get last item from data structure
     * @since 1.0.0
     *
     * @return null|TValue
     */
    public function tail ():mixed;

}
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

use FireHub\Core\Support\Enums\ {
    Order, Sort
};

/**
 * ### Sortable data structures can have their keys sorted
 * @since 1.0.0
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Contracts\Sortable<TKey, TValue>
 */
interface KeySortable extends Sortable {

    /**
     * ### Sort key of the data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Order As parameter.
     * @uses \FireHub\Core\Support\Enums\Sort As parameter.
     *
     * @param \FireHub\Core\Support\Enums\Order $order [optional] <p>
     * Order type.
     * </p>
     * @param \FireHub\Core\Support\Enums\Sort $flag [optional] <p>
     * Sort flag.
     * </p>
     *
     * @return $this New sorted data structure.
     */
    public function sortKeys (Order $order = Order::ASC, Sort $flag = Sort::BY_REGULAR):static;

    /**
     * ### Sort the data structure keys with a user-defined comparison function
     * @since 1.0.0
     *
     * @param callable(TKey, TKey):int<-1, 1> $callback <p>
     * The comparison function must return an integer less than, equal to, or greater than zero if the first argument
     * is considered to be respectively less than, equal to, or greater than the second.
     * </p>
     *
     * @return $this New sorted data structure.
     */
    public function sortKeysBy (callable $callback):static;

}
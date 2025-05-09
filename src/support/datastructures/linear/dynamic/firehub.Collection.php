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

namespace FireHub\Core\Support\DataStructures\Linear\Dynamic;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic;
use FireHub\Core\Support\DataStructures\Contracts\Selectable;
use FireHub\Core\Support\DataStructures\Function\Reduce;
use FireHub\Core\Support\DataStructures\Traits\Enumerable;

/**
 * ### Abstract collection type
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic<TKey, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Selectable<TKey, TValue>
 */
abstract class Collection implements Dynamic, Selectable {

    /**
     * ### Enumerable data structure methods that every element meets a given criterion
     * @since 1.0.0
     *
     * @use \FireHub\Core\Support\DataStructures\Traits\Enumerable<TKey, TValue>
     */
    use Enumerable;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Function\Reduce As reduce function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->reduce(fn($carry, $value) => $carry.'-'.$value);
     *
     * // 'John-Jane-Jane-Jane-Richard-Richard-'
     * ```
     */
    public function reduce (callable $callback, mixed $initial = null):mixed {

        return new Reduce($this)($callback, $initial);

    }

}
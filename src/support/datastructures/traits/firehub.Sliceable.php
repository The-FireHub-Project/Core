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

namespace FireHub\Core\Support\DataStructures\Traits;

/**
 * ### This trait allows usage of slicing methods
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
trait Sliceable {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    abstract public function slice (int $offset, ?int $length = null):static;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    abstract public function nth (int $step, int $offset = 0, ?int $length = null):static;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Traits\Sliceable::nth() To get even elements.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $even = $collection->even();
     *
     * // ['Jane', 'Jane', 'Richard']
     * ```
     */
    public function even ():static {

        return $this->nth(2, 1); // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Traits\Sliceable::nth() To get odd elements.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $odd = $collection->odd();
     *
     * // ['John', 'Jane', 'Richard']
     * ```
     */
    public function odd ():static {

        return $this->nth(2); // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Traits\Sliceable::slice() To get a slice from a data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $take = $collection->take(2);
     *
     * // ['John', 'Jane']
     * ```
     */
    public function take (int $count):static {

        return $this->slice(0, $count); // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Traits\Sliceable::slice() To get a slice from a data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $merged = $collection->skip(2);
     *
     * // ['Jane', 'Jane', 'Richard', 'Richard']
     * ```
     */
    public function skip (int $count):static {

        return $this->slice($count); // @phpstan-ignore return.type

    }

}
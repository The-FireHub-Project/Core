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

namespace FireHub\Core\Support\DataStructures\Linear;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use Closure, Generator, Traversable;

/**
 * ### Lazy data structure type
 *
 * Lazy data structures allow you to work with large datasets while keeping memory usage low.
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic<TKey, TValue>
 *
 * @api
 */
class Lazy implements Dynamic {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var Generator<TKey, TValue>
     */
    protected Generator $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param Closure():Generator<TKey, TValue> $callable <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     */
    public function __construct (Closure $callable) {

        $this->storage = ($callable)();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function count ():int {

        return new CountBy($this)->elements();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function getIterator ():Traversable {

        yield from $this->storage;

    }

}
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

namespace FireHub\Core\Support\Contracts\Iterator;

use IteratorAggregate as InternalIteratorAggregate, Traversable as InternalTraversable;

/**
 * ### Base iterator aggregate contract
 *
 * Interface for external iterators or objects that can be iterated themselves internally.
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\Iterator\Traversable<TKey, TValue>
 * @extends InternalIteratorAggregate<TKey, TValue>
 */
interface IteratorAggregate extends Traversable, InternalIteratorAggregate {

    /**
     * ### Retrieve an external iterator
     * @since 1.0.0
     *
     * @return InternalTraversable<TKey, TValue> An instance of an object implementing Iterator or Traversable.
     */
    public function getIterator ():InternalTraversable;

}
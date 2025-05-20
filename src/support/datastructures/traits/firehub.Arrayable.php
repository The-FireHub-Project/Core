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

use FireHub\Core\Support\Traits\ {
    Jsonable, Serializable
};
use FireHub\Core\Support\LowLevel\ {
    Arr, Iterables
};
use ArgumentCountError;

/**
 * ### Arrayable data structure methods have an array as storage
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
trait Arrayable {

    /**
     * ### Trait contains all common JSON methods
     * @since 1.0.0
     */
    use Jsonable;

    /**
     * ### Trait contains all common serialize and unserialize methods
     * @since 1.0.0
     */
    use Serializable;

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var array<TKey, TValue>
     */
    protected array $storage;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count array items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $count = $collection->count();
     *
     * // 6
     */
    public function count ():int {

        return Iterables::count($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::map() To apply the callback to the elements of the given array.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->transform(fn($value) => $value.'.');
     *
     * // ['firstname' => 'John.', 'lastname' => 'Doe.', 'age' => '25.', 10 => '2.']
     * ```
     */
    public function transform (callable $callback):self {

        try {

            $this->storage = Arr::map($this->storage, $callback);

        } catch (ArgumentCountError) {

            foreach ($this->storage as $key => $value) $this->storage[$key] = $callback($value, $key);

        }

        return $this;

    }

}
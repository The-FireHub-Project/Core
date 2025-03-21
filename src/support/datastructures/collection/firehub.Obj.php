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

namespace FireHub\Core\Support\DataStructures\Collection;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Collection;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use SplObjectStorage, Traversable;

/**
 * ### Object collection type
 *
 * Object collection provides a map from objects to data or, by ignoring data, an object set.
 * This dual purpose can be useful in many cases involving the need to uniquely identify objects.
 * @since 1.0.0
 *
 * @template TKey of object
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Collection<TKey, TValue>
 *
 * @api
 */
class Obj implements Collection {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var SplObjectStorage<TKey, TValue>
     */
    private SplObjectStorage $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {

        $this->storage = new SplObjectStorage();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy::elements() To count elements in a data structure.
     */
    public function count ():int {

        return new CountBy($this)->elements();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy As return.
     */
    public function countBy ():CountBy {

        return new CountBy($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Collection\Obj;
     *
     * $collection = new Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->first();
     *
     * // 'data for object 1'
     * ```
     * @example With $callback parameter.
     * ```php
     * use FireHub\Core\Support\DataStructures\Collection\Obj;
     *
     * $collection = new Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->first(function ($info, $object) use ($cls1) {
     *  return $object === $cls1;
     * });
     *
     * // 'data for object 1'
     * ```
     */
    public function first (?callable $callback = null):mixed {

        if ($callback) {

            foreach ($this->storage as $object)
                if ($callback($this->storage[$object], $object)) return $this->storage[$object];

            return null;

        }

        $this->storage->rewind();

        return $this->storage->valid() ? $this->storage->getInfo() : null;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Collection\Obj::count() To count elements in the iterator.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Collection\Obj;
     *
     * $collection = new Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->last();
     *
     * // 20
     * ```
     * @example With $callback parameter.
     * ```php
     * use FireHub\Core\Support\DataStructures\Collection\Obj;
     *
     * $collection = new Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->last(function ($info) use ($cls1) {
     *  return $info !== 20;
     * });
     *
     * // [1,2,3]
     * ```
     */
    public function last (?callable $callback = null):mixed {

        if ($callback) {

            $found = null;

            foreach ($this->storage as $object)
                if ($callback($this->storage[$object], $object)) $found = $this->storage[$object];

            return $found;

        }

        $counter = 0;

        $count = $this->count();

        foreach ($this->storage as $object) if (++$counter === $count) return $this->storage[$object];

        return null;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Collection\Obj;
     *
     * $collection = new Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection[$cls1] = 'data 1';
     * $collection[$cls2] = 'data 2';
     * $collection[$cls3] = 'data 3';
     *
     * $collection->toArray();
     *
     * // [
     * // ['info' => 'data 1', 'object' => object(stdClass)]
     * // ['info' => 'data 2', 'object' => object(stdClass)]
     * // ['info' => 'data 3', 'object' => object(stdClass)]
     * // ]
     * ```
     *
     * @return list<array{info: TValue, object: TKey}> Collection as an array.
     */
    public function toArray ():array {

        $result = [];

        foreach ($this as $object => $data) {
            $result[] = ['info' => $data, 'object' => $object];
        }

        return $result;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetExists (mixed $offset):bool {

        return isset($this->storage[$offset]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetGet (mixed $offset):mixed {

        return $this->storage[$offset];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetSet (mixed $offset, mixed $value):void {

        $this->storage[$offset] = $value;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetUnset (mixed $offset):void {

        unset($this->storage[$offset]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function getIterator ():Traversable {

        foreach ($this->storage as $object)
            yield $object => $this->storage[$object];

    }

}
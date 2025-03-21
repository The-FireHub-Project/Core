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

namespace FireHub\Core\Support\DataStructures;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Fixed as FixedContract;
use FireHub\Core\Support\Contracts\JsonSerializable;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use FireHub\Core\Support\LowLevel\JSON;
use SplFixedArray, Traversable;

/**
 * ### Fixed data structure type
 *
 * Fixed data structure allows only integers as keys, but it is faster and uses less memory than an array collection.
 * This collection type must be resized manually and allows only integers within the range as indexes.
 * @since 1.0.0
 *
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Fixed<int, null|TValue>
 */
class Fixed implements FixedContract, JsonSerializable {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var SplFixedArray<TValue>
     */
    private SplFixedArray $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param positive-int $size <p>
     * Size of the data structure.
     * </p>
     *
     * @return void
     */
    public function __construct (int $size) {

        $this->storage = new SplFixedArray($size);

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
     * ### Get JSON representation for the data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\JSON::encode() To encode data structure to JSON.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->toJSON();
     *
     * // ["one","two","three"]
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\JSONException If JSON encoding throws an error.
     *
     * @return string JSON representation for the data structure.
     */
    public function toJSON ():string {

        return JSON::encode($this) ?: '[]';

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function jsonSerialize ():array {

        return $this->storage->jsonSerialize();

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

        yield from $this->storage;

    }

}
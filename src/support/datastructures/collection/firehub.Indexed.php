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
use FireHub\Core\Support\Contracts\JsonSerializable;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use FireHub\Core\Support\LowLevel\JSON;
use Closure, Traversable;

/**
 * ### Indexed array collection type
 *
 * Collections which have numerical indexes in an ordered sequential manner (starting from 0 and ending with n-1).
 * @since 1.0.0
 *
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Collection<int, TValue>
 */
class Indexed implements Collection, JsonSerializable {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var array<TValue>
     */
    protected array $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param array<TValue>|Closure():array<TValue> $array <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     */
    public function __construct (array|Closure $array) {

        $array instanceof Closure ? $this->storage = ($array)() : $this->storage = $array;

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
     * @throws \FireHub\Core\Support\Exceptions\JSONException If JSON encoding throws an error.
     */
    public function toJSON ():string {

        return JSON::encode($this) ?: '[]';

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @return array<TValue> Data that can be serialized by json_encode().
     */
    public function jsonSerialize ():array {

        return $this->storage;

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

        $this->storage[] = $value;

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
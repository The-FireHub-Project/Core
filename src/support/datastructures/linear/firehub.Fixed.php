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

use FireHub\Core\Support\Contracts\HighLevel\ {
    DataStructures, DataStructures\Linear\Fixed as FixedContract
};
use FireHub\Core\Support\DataStructures\Contracts\ {
    Chunkable, Filterable, Reversible
};
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\DataStructures\Traits\Enumerable;
use FireHub\Core\Support\Traits\ {
    Jsonable, Serializable
};
use FireHub\Core\Support\LowLevel\ {
    Iterables, Iterator
};
use SplFixedArray;

/**
 * ### Fixed data structure type
 *
 * Fixed data structure allows only integers as keys, but it is faster and uses less memory than an array data
 * structure.
 * This data structure type must be resized manually and allows only integers within the range as indexes.
 * @since 1.0.0
 *
 * @template TValue
 *
 * @extends SplFixedArray<TValue>
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed<int, ?TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Chunkable<int, ?TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Filterable<int, ?TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Reversible<int, ?TValue>
 *
 * @api
 */
class Fixed extends SplFixedArray implements FixedContract, Chunkable, Filterable, Reversible {

    /**
     * ### Enumerable data structure methods that every element meets a given criterion
     * @since 1.0.0
     *
     * @use \FireHub\Core\Support\DataStructures\Traits\Enumerable<int, ?TValue>
     */
    use Enumerable;

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
     * ### Constructor
     * @since 1.0.0
     *
     * @param non-negative-int $size <p>
     * The size of the fixed array.
     * </p>
     *
     * @return void
     */
    final public function __construct (int $size) {

        parent::__construct($size);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::count() To get the number of elements
     * in the provided data structure.
     */
    public static function fromDataStructure (DataStructures $data_structure):static {

        $storage = new static($data_structure->count());

        $i = 0;

        foreach ($data_structure as $item)
            $storage[$i++] = $item;

        return $storage;

    }

    /**
     * ### Create a data structure from an array
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count array parameter items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $array = ['one', 'two', 'three'];
     *
     * $collection = Fixed::fromArray($array);
     * ```
     *
     * @param array<int, null|TValue> $array <p>
     * Data for data structure.
     * </p>
     * @param bool $preserve_keys [optional] <p>
     * Try to save the numeric indexes used in the original array.
     * </p>
     *
     * @return static<TValue> Data structure from an array.
     *
     * @phpstan-ignore method.childParameterType
     */
    public static function fromArray (array $array, bool $preserve_keys = false):static {

        $storage = new static(Iterables::count($array));

        if ($preserve_keys) {

            foreach ($array as $key => $item)
                $storage[$key] = $item;

        } else {

            $i = 0;

            foreach ($array as $item)
                $storage[$i++] = $item;

        }

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @return non-negative-int Size of the data structure.
     */
    public function getSize ():int {

        return parent::getSize() > 0 ? parent::getSize() : 0;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function setSize (int $size):true {

        return parent::setSize($size); // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $array = $collection->toArray();
     *
     * // ['one', 'two', 'three']
     * ```
     *
     * @return array<int, null|TValue> Data structure data as an array.
     */
    public function toArray ():array {

        return Iterator::toArray($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->transform(fn($value, $key) => $value.'.');
     *
     * // ['one.', 'two.', 'three.']
     * ```
     */
    public function transform (callable $callback):self {

        foreach ($this as $key => $value) $this[$key] = $callback($value, $key);

        return $this;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::getSize() To get the size of the current data structure.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::setSize() To set the size for the new data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $filter = $collection->filter(fn($value) => $value !== 'two');
     *
     * // ['one', 'three']
     * ```
     */
    public function filter (callable $callback):static {

        $storage = new static($this->getSize());

        $counter = 0;
        foreach ($this as $key => $value) {

            $result = $callback($value, $key);

            if ($result === 'break') break;
            !$result ?: $storage[$counter++] = $value;

        }

        $storage->setSize($counter);

        return $storage;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::getSize() To get the size of the current data structure.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::setSize() To set the size for the new data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $chunk = $collection->chunkWhere(fn($value, $key) => $value === 'two');
     *
     * // [['one', 'two'], ['three']]
     * ```
     */
    public function chunkWhere (callable $callback):Lazy {

        return new Lazy(function () use ($callback) {

            $chunks = new static($this->getSize()); $counter = 0;
            foreach ($this as $key => $value) {

                $chunks[$counter++] = $value;

                if ($callback($value, $key)) {

                    $chunks->setSize($counter);

                    yield $chunks;

                    $chunks = new static($this->getSize());

                    $counter = 0;

                }

            }

            if ($chunks[0] !== null) {

                $chunks->setSize($counter);
                yield $chunks;

            }

        });

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::getSize() To get size of current data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->reverse();
     *
     * // ['three', 'two', 'one']
     * ```
     */
    public function reverse ():static {

        $count = $this->getSize();

        foreach ($this as $key => $value) {

            $index = $count - 1 - $key;

            $this[$index] = $value;

        }

        return $this;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @return array<TValue> Data which can be serialized by json_encode(), which is a value of any type other than a
     * resource.
     */
    public function jsonSerialize ():array {

        return parent::jsonSerialize();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @return array<TValue> An associative array of key/value pairs that represent the serialized form of the object.
     */
    public function __serialize ():array {

        return $this->jsonSerialize();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count array parameter items.
     *
     * @param array<int, null|TValue> $data <p>
     * Serialized data.
     * </p>
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    public function __unserialize (array $data):void {

        $this->setSize(Iterables::count($data));

        $i = 0;
        foreach ($data as $item)
            $this[$i++] = $item;

    }

}
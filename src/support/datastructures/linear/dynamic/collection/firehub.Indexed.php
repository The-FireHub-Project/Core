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

namespace FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection;

use FireHub\Core\Support\Contracts\HighLevel\ {
    DataStructures, DataStructures\Linear
};
use FireHub\Core\Support\DataStructures\Contracts\ {
    ArrayableStorage, Filterable, Sequantionable
};
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection;
use FireHub\Core\Support\DataStructures\Traits\Arrayable;
use FireHub\Core\Support\LowLevel\Arr;
use Traversable;

use function FireHub\Core\Support\Helpers\Arr\ {
    first, last, random
};

/**
 * ### Indexed array collection type
 *
 * Collections which have numerical indexes in an ordered sequential manner (starting from 0 and ending with n-1).
 * @since 1.0.0
 *
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<int, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\ArrayableStorage<int, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Filterable<int, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Sequantionable<TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Indexed extends Collection implements ArrayableStorage, Filterable, Sequantionable {

    /**
     * ### Arrayable data structure methods have an array as storage
     * @since 1.0.0
     *
     * @use \FireHub\Core\Support\DataStructures\Traits\Arrayable<int, TValue>
     */
    use Arrayable;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::values() To help with removing keys from an array.
     *
     * @param array<TValue> $storage [optional] <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     *
     * @caution This collection will reindex the provided array if it is not already numerically indexed.
     */
    public function __construct (
        protected array $storage = []
    ) {

        $this->storage = Arr::values($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public static function fromDataStructure (DataStructures $data_structure):static {

        $storage = [];

        foreach ($data_structure as $value)
            $storage[] = $value;

        return new static($storage);

    }

    /**
     * ### Create a data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $array = ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard'];
     *
     * $collection = Indexed::fromArray($array);
     * ```
     *
     * @param TValue[] $array <p>
     * Data for data structure.
     * </p>
     *
     * @return static<TValue> Data structure from an array.
     */
    public static function fromArray (array $array):static {

        return new static($array);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::shift() To remove an item at the beginning of the data structure if
     * $items value is 5 or less.
     * @uses \FireHub\Core\Support\LowLevel\Arr::splice() To remove an item at the beginning of the data structure if
     * $items value is more than 5.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->shift();
     *
     * // ['Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     * @example Removing more than one item.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->shift(3);
     *
     * // ['Jane', 'Richard', 'Richard']
     * ```
     */
    public function shift (int $items = 1):void {

        if ($items <= 5)
            for ($i = 0; $i < $items; $i++) Arr::shift($this->storage);

        else Arr::splice($this->storage, 0, $items);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::pop() To remove an item at the end of the data collection if
     * $items value is 5 or less.
     * @uses \FireHub\Core\Support\LowLevel\Arr::splice() To remove an item at the end of the data collection if
     * $items value is greater than 5.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->pop();
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard']
     * ```
     * @example Removing more than one item.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->pop(3);
     *
     * // ['John', 'Jane', 'Jane']
     * ```
     */
    public function pop (int $items = 1):void {

        if ($items <= 5)
            for ($i = 0; $i < $items; $i++) Arr::pop($this->storage);

        else Arr::splice($this->storage, -$items);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->prepend('Johnie', 'Janie', 'Baby');
     *
     * // ['Johnie', 'Janie', 'Baby', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     */
    public function prepend (mixed ...$values):void {

        $this->storage = [...$values, ...$this->storage];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->append('Johnie', 'Janie', 'Baby');
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']
     * ```
     */
    public function append (mixed ...$values):void {

        $this->storage = [...$this->storage, ...$values];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\first() To get the first value from the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $head = $collection->head()
     *
     * // 'John'
     * ```
     */
    public function head ():mixed {

        return first($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\last() To get the last value from the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $tail = $collection->tail();
     *
     * // 'Richard'
     * ```
     */
    public function tail ():mixed {

        return last($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\random() To pick one or more random values out of the array.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $random = $collection->random($collection2);
     *
     * // ['Jane']
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException If an array is empty, or if the number is
     * out of range.
     */
    public function random (int $number = 1):mixed {

        $result = random($this->storage, $number);

        return $number > 1
            ? new static($result)
            : $result;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $array = $collection->toArray();
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     *
     * @return array<TValue> Data structure data as an array.
     */
    public function toArray ():array {

        return $this->storage;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $filter = $collection->filter(fn($value) => $value === 'Jane');
     *
     * // ['Jane', 'Jane', 'Jane']
     * ```
     */
    public function filter (callable $callback):static {

        $storage = [];

        foreach ($this->storage as $key => $value) {

            $result = $callback($value, $key);

            if ($result === 'break') break;
            if ($result) $storage[] = $value;

        }

        return new static($storage);

    }

    /**
     * ### Join a new data structure into the current one
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed::append() To add items at the end
     * of the data collection.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::values() To get values from joined
     * data structures.
     *
     * @template TMergedValue
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     * $collection2 = new Indexed(['Johnie', 'Janie', 'Baby']);
     *
     * $join = $collection->join($collection2);
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']
     * ```
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear<mixed, TMergedValue> ...$data_structures <p>
     * List of data structures to join.
     * </p>
     *
     * @return static<TValue|TMergedValue> New joined data structure.
     */
    public function join (Linear ...$data_structures):static {

        $storage = clone $this;

        foreach ($data_structures as $data_structure)
            $storage->append(...$data_structure->values());

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Cross join a new data structure into the current one
     * @since 1.0.0
     *
     * @template TMergedValue
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     * $collection2 = new Indexed(['Johnie', 'Janie', 'Baby']);
     *
     * $join = $collection->join($collection2);
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']
     * ```
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear<mixed, TMergedValue> ...$data_structures <p>
     * List of data structures to join.
     * </p>
     *
     * @return static<TValue|TMergedValue> New crossed joined data structure.
     */
    public function crossJoin (Linear ...$data_structures):static {

        $storage = [[]];

        foreach ([$this, ...$data_structures] as $index => $value) {

            $result = [];
            foreach ($storage as $product)
                foreach ($value as $item) {

                    $product[$index] = $item;

                    $result[] = $product;

                }

            $storage = $result;

        }

        return new static($storage); // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::reverse() To reverse the order of array items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $reverse = $collection->reverse($collection2);
     *
     * // ['Richard', 'Richard', 'Jane', 'Jane', 'Jane', 'John']
     * ```
     */
    public function reverse ():static {

        return new static(Arr::reverse($this->storage));

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::shuffle() To shuffle the array items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $shuffle = $collection->shuffle($collection2);
     *
     * // ['Jane', 'Richard', 'Jane', 'John', 'Jane', 'Richard']
     * ```
     */
    public function shuffle ():static {

        $storage = $this->storage;

        Arr::shuffle($storage);

        return new static($storage);

    }

    /**
     * ### Pad a collection to the specified length with a value
     * @since 1.0.0
     *
     * @template TPaddedValue
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $pad = $collection->pad(10, 'Daniel');
     *
     * // ['Jane', 'Richard', 'Jane', 'John', 'Jane', 'Richard', 'Daniel', 'Daniel', 'Daniel', 'Daniel']
     * ```
     * @example With negative size.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $pad = $collection->pad(-10, 'Daniel');
     *
     * // ['Daniel', 'Daniel', 'Daniel', 'Daniel', 'Jane', 'Richard', 'Jane', 'John', 'Jane', 'Richard']
     * ```
     *
     * @param int $size <p>
     * New size of the array.
     * If the length is positive, then the array is padded on the right if it is negative, then on the left.
     * If the absolute value of length is less than or equal to the length of the array, then no padding takes place.
     * </p>
     * @param TPaddedValue $value <p>
     * Value to pad if input is less than length.
     * </p>
     *
     * @return static<TValue|TPaddedValue> New data structure with padded value.
     */
    public function pad (int $size, mixed $value):static {

        return new static(Arr::pad($this->storage, $size, $value));

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed::toArray() To get data structure
     * an array.
     *
     * @return array<TValue> Data which can be serialized by json_encode(), which is a value of any type
     * other than a resource.
     */
    public function jsonSerialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function getIterator ():Traversable {

        yield from $this->storage;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @return array<TValue> An associative array of key/value pairs that represent the serialized form of the object.
     */
    public function __serialize ():array {

        return $this->storage;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param array<TValue> $data <p>
     * Serialized data.
     * </p>
     */
    public function __unserialize (array $data):void {

        $this->storage = $data;

    }

}
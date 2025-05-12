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

use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection;
use FireHub\Core\Support\DataStructures\Contracts\ {
    ArrayableStorage, Sequantionable
};
use FireHub\Core\Support\DataStructures\Traits\Arrayable;
use FireHub\Core\Support\Traits\ {
    Jsonable, Serializable
};
use FireHub\Core\Support\LowLevel\Arr;

use function FireHub\Core\Support\Helpers\Arr\ {
    first, last
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
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Sequantionable<TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Indexed extends Collection implements ArrayableStorage, Sequantionable {

    /**
     * ### Arrayable data structure methods have an array as storage
     * @since 1.0.0
     *
     * @use \FireHub\Core\Support\DataStructures\Traits\Arrayable<int, TValue>
     */
    use Arrayable;

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
     * @var TValue[]
     */
    protected array $storage;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param array<TValue> $storage [optional] <p>
     * Underlying storage data.
     * </p>
     */
    public function __construct (array $storage = []) {

        $this->storage = Arr::values($storage);

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
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->toArray();
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
     * ### Merge a new data structure into the current one
     * @since 1.0.0
     *
     * @uses static::toArray() To get data structure data as an array.
     *
     * @template TMergeValue
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     * $collection2 = new Indexed(['Johnie', 'Janie', 'Baby']);
     *
     * $merged = $collection->merge($collection2);
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']
     * ```
     *
     * @param self<TMergeValue> ...$data_structures <p>
     * Data structures to merge.
     * </p>
     *
     * @return static<TValue|TMergeValue> New merged data structure.
     */
    public function merge (self ...$data_structures):static {

        $storage = $this->storage;

        foreach ($data_structures as $data_structure)
            $storage = [...$storage,  ...$data_structure->toArray()];

        return new static($storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::slice() To extract a slice of the array.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $slice = $collection->slice(1, 4);
     *
     * // ['Jane', 'Jane', 'Jane', 'Richard']
     * ```
     */
    public function slice (int $offset, ?int $length = null):static {

        $storage = Arr::slice($this->storage, $offset, $length);

        return new static($storage);

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
     * $take_until = $collection->takeUntil(function ($value) {
     *  return $value === 'Richard';
     * });
     *
     * // ['John', 'Jane', 'Jane', 'Jane']
     * ```
     */
    public function takeUntil (callable $callback):static {

        $storage = [];

        foreach ($this->storage as $value) {

            if ($callback($value)) break;

            $storage[] = $value;

        }

        return new static($storage);

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
     * $take_while = $collection->takeWhile(function ($value) {
     *  return $value === 'Richard';
     * });
     *
     * // ['John', 'Jane', 'Jane', 'Jane']
     * ```
     */
    public function takeWhile (callable $callback):static {

        $storage = [];

        foreach ($this->storage as $value) {

            if (!$callback($value)) break;

            $storage[] = $value;

        }

        return new static($storage);

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
     * $skip_until = $collection->skipUntil(function ($value) {
     *  return $value !== 'Richard';
     * });
     *
     * // ['Richard', 'Richard']
     * ```
     */
    public function skipUntil (callable $callback):static {

        $storage = [];

        $found = false;
        foreach ($this->storage as $value) {

            if (!$found && !$callback($value)) continue;

            $found = true;

            $storage[] = $value;

        }

        return new static($storage);

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
     * $skip_while = $collection->skipWhile(function ($value) {
     *  return $value === 'John';
     * });
     *
     * // ['Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     */
    public function skipWhile (callable $callback):static {

        $storage = [];

        $found = false;
        foreach ($this->storage as $value) {

            if (!$found && $callback($value)) continue;

            $found = true;

            $storage[] = $value;

        }

        return new static($storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed::slice() To get a slice from a data
     * structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = $collection->nth(2);
     *
     * // ['John', 'Jane', 'Richard']
     * ```
     * @example With offset and length.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $nth = $collection->nth(2, 1, 4);
     *
     * // ['Jane', 'Jane']
     * ```
     */
    public function nth (int $step, int $offset = 0, ?int $length = null):static {

        $storage = []; $counter = 0;
        foreach (
            $offset !== 0 || $length !== null
                ? $this->slice($offset, $length)
                : $this->storage as $value
        ) if ($counter++ % (max($step, 1)) === 0) $storage[] = $value;

        return new static($storage);

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

        if ($items <= 5) {

            for ($i = 0; $i < $items; $i++) Arr::shift($this->storage);

        } else {

            Arr::splice($this->storage, 0, $items);

        }

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

        if ($items <= 5) {

            for ($i = 0; $i < $items; $i++) Arr::pop($this->storage);

        } else {

            Arr::splice($this->storage, -$items);

        }

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
     * $collection->head()
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
     * $collection->tail();
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
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr::toArray() To get data structure
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
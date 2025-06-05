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

namespace FireHub\Core\Support\DataStructures\Linear\Dynamic;

use FireHub\Core\Support\Contracts\HighLevel\ {
    DataStructures, DataStructures\Linear, DataStructures\Linear\Dynamic
};
use FireHub\Core\Support\DataStructures\Traits\Enumerable;
use FireHub\Core\Support\Traits\ {
    Jsonable, Serializable
};
use FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException;
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
     * ### Enumerable data structure methods that every element meets a given criterion
     * @since 1.0.0
     *
     * @use \FireHub\Core\Support\DataStructures\Traits\Enumerable<TKey, TValue>
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
     * @param Closure():Generator<TKey, TValue> $storage <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     */
    final public function __construct (
        protected Closure $storage
    ) {}

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public static function fromDataStructure (DataStructures $data_structure):static {

        return new static (static function () use ($data_structure) {

            foreach ($data_structure as $key => $value)
                yield $key => $value;

        });

    }

    /**
     * ### Create a data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
     *
     * $array = ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2];
     *
     * $collection = Lazy::fromArray($array);
     * ```
     * @param array<array{key: TKey, value: TValue}> $array <p>
     * Data for data structure.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException If $data is missing from the
     * storage data.
     *
     * @return static<TKey, TValue> Data structure from an array.
     *
     * @phpstan-ignore method.childParameterType
     */
    public static function fromArray (array $array):static {

        return new static (static function () use ($array) {

            foreach ($array as $item)
                yield $item['key']
                    ?? throw new StorageMissingDataException()->withData($item)->withKey('key')
                => $item['value']
                    ?? throw new StorageMissingDataException()->withData($item)->withKey('value');

        });

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
     *
     * $collection = new Lazy(fn() => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $array = $collection->exist(0);
     *
     * // [
     * //   ['key' => 'firstname' => 'firstname', 'value' => 'John'],
     * //   ['key' => 'lastname', 'value' => 'Doe'],
     * //   ['key' => 'age', 'value' => 25],
     * //   ['key' => 10, 'value' => 2]
     * // ]
     * ```
     *
     * @return array<array{key: TKey, value: TValue}> Data structure data as an array.
     */
    public function toArray ():array {

        $result = [];

        foreach ($this as $key => $value)
            $result[] = ['key' => $key, 'value' => $value];

        return $result;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
     *
     * $collection = new Lazy(fn() => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->transform(fn($value, $key) => $value.'.');
     *
     * // ['firstname' => 'John.', 'lastname' => 'Doe.', 'age' => '25.', 10 => '2.']
     * ```
     */
    public function transform (callable $callback):self {

        $storage = ($this->storage)();

        $this->storage = static function () use ($callback, $storage) { // @phpstan-ignore assign.propertyType
            foreach ($storage as $key => $value) {
                yield $key => $callback($value, $key);
            }
        };

        return $this;

    }

    /**
     * ### Join a new data structure into the current one
     * @since 1.0.0
     *
     * @template TMergedKey
     * @template TMergedValue
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
     *
     * $collection = new Lazy(fn() => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * $collection2 = new Lazy(fn() => yield from ['middlename' => 'Marry']);
     *
     * $join = $collection->join($collection2);
     *
     * // ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'middlename' => 'Marry']
     * ```
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear<TMergedKey, TMergedValue> ...$data_structures <p>
     * List of data structures to join.
     * </p>
     *
     * @return static<TKey|TMergedKey, TValue|TMergedValue> New joined data structure.
     */
    public function join (Linear ...$data_structures):static {

        return new static (function () use ($data_structures) {

            yield from $this;

            foreach ([...$data_structures] as $data_structure)
                foreach ($data_structure as $key => $value)
                    yield $key => $value;

        });

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy::toArray() To get data structure an array.
     *
     * @return array<array{key: TKey, value: TValue}> Data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy::invoke() To invoke storage.
     */
    public function getIterator ():Traversable {

        return $this->invoke();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy::toArray() To get data structure an array.
     *
     * @return array<array{key: TKey, value: TValue}> An associative array of key/value pairs that represent
     * the serialized form of the object.
     */
    public function __serialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy::invoke() To invoke storage.
     *
     * @param array<array{key: TKey, value: TValue}> $data <p>
     * Serialized data.
     * </p>
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    public function __unserialize (array $data):void {

        $this->storage = static function () use ($data) {

            foreach ($data as $item)
                yield $item['key']
                    ?? throw new StorageMissingDataException()->withData($item)->withKey('key')
                => $item['value']
                    ?? throw new StorageMissingDataException()->withData($item)->withKey('value');

        };

        $this->invoke();

    }

    /**
     * ### Invoke storage
     * @since 1.0.0
     *
     * @return Generator<TKey, TValue> Storage data.
     */
    private function invoke ():Generator {

        yield from ($this->storage)();

    }

}
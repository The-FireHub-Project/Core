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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, When
};
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
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Lazy implements Dynamic {

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
    public function __construct (
        protected Closure $storage
    ) {}

    /**
     * ### Create data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
     *
     * $collection = Lazy::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * ```
     * @param array<array{key: TKey, value: TValue}> $array <p>
     * Data for data structure.
     * </p>
     *
     * @return static<TKey, TValue> Data structure from an array.
     */
    public static function fromArray (array $array):static {

        return new static(function () use ($array) {

            foreach ($array as $item)
                yield $item['key'] => $item['value'];

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
     * $collection->exist(0);
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
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection::countBy() To count elements in
     * a data structure.
     */
    public function count ():int {

        return $this->countBy()->elements();

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
     * @uses \FireHub\Core\Support\DataStructures\Operation\When<static> As return.
     */
    public function when ():When {

        return new When($this);

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
     */
    public function jsonSerialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy::toArray() To get data structure an array.
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
                yield $item['key'] => $item['value'];

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
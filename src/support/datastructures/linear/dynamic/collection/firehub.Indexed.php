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

use FireHub\Core\Support\DataStructures\Contracts\Listable;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection;
use FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException;
use FireHub\Core\Support\LowLevel\Arr;
use Closure, Traversable, TypeError;

/**
 * ### Indexed array collection type
 *
 * Collections which have numerical indexes in an ordered sequential manner (starting from 0 and ending with n-1).
 * @since 1.0.0
 *
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<int, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Listable<int, TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Indexed extends Collection implements Listable {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var TValue[]
     */
    protected array $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\values() To get all values from a provided array.
     *
     * @param Closure():array<TValue> $storage <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     */
    public function __construct (Closure $storage) {

        $this->storage = Arr::values(($storage)());

    }

    /**
     * ### Create data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     * ```
     * @param array<TValue> $array <p>
     * Data for data structure.
     * </p>
     *
     * @return static<TValue> Data structure from an array.
     */
    public static function fromArray (array $array):static {

        return new static(fn() => $array);

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
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
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
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::shift() To remove an item at the beginning of the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->shift();
     *
     * // ['Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     */
    public function shift ():void {

        Arr::shift($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::unshift() To push an item at the beginning of the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->unshift('Johnie', 'Janie', 'Baby');
     *
     * // ['Johnie', 'Janie', 'Baby', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     *
     * @param TValue $value <p>
     * Value to unshift.
     * </p>
     * @param TValue ...$and_values [optional] <p>
     * List of values to unshift.
     * </p>
     */
    public function unshift (mixed $value, mixed ...$and_values):void {

        Arr::unshift($this->storage, $value, ...$and_values);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::pop() To pop an item at the end of the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->pop();
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard']
     * ```
     */
    public function pop ():void {

        Arr::pop($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::push() To push an item at the end of the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->push('Johnie', 'Janie', 'Baby');
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']
     * ```
     *
     * @param TValue $value <p>
     * Value to push.
     * </p>
     * @param TValue ...$and_values [optional] <p>
     * List of values to push.
     * </p>
     */
    public function push (mixed $value, mixed ...$and_values):void {

        Arr::push($this->storage, $value, ...$and_values);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function offsetExists (mixed $offset):bool {

        try {

            return isset($this->storage[$offset]);

        } catch (TypeError) {

            throw new CannotAccessOffsetException()->withValue($offset);

        }

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function offsetGet (mixed $offset):mixed {

        try {

            return $this->storage[$offset];

        } catch (TypeError) {

            throw new CannotAccessOffsetException()->withValue($offset);

        }

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetSet (mixed $offset, mixed $value):void {

        isset($offset)
            ? $this->storage[$offset] = $value
            : $this->storage[] = $value;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function offsetUnset (mixed $offset):void {

        try {

            unset($this->storage[$offset]);

        } catch (TypeError) {

            throw new CannotAccessOffsetException()->withValue($offset);

        }

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
     * @param array<TValue> $data <p>
     * Serialized data.
     * </p>
     */
    public function __unserialize (array $data):void {

        $this->storage = $data;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param array<TValue> $data <p>
     * Decoded JSON string as an array.
     * </p>
     *
     * @return static<mixed> Object from JSON encoded parameter.
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    protected static function jsonToObject (array $data):static {

        return new static(fn() => $data);

    }

}
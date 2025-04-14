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
use FireHub\Core\Support\DataStructures\Contracts\Overloadable;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    CannotAccessOffsetException, KeyAlreadyExistException, KeyDoesntExistException
};
use Closure, Traversable, TypeError;

/**
 * ### Associative array collection type
 *
 * Collections that use named keys that you assign to them.
 * @since 1.0.0
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<TKey, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Overloadable<TKey, TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Associative extends Collection implements Overloadable {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var array<TKey, TValue>
     */
    protected array $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param Closure():array<TKey, TValue> $storage <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     */
    public function __construct (Closure $storage) {

        $this->storage = ($storage)();

    }

    /**
     * ### Create data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * ```
     *
     * @param array<TKey, TValue> $array <p>
     * Data for data structure.
     * </p>
     *
     * @return static<TKey, TValue> Data structure from an array.
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
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->toArray();
     *
     * // ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]
     * ```
     *
     * @return array<TKey, TValue> Data structure data as an array.
     */
    public function toArray ():array {

        return $this->storage;

    }

    /**
     * ### Check if item exist in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetExists() Checks
     * whether an offset exists.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->exist('firstname');
     *
     * // true
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     *
     * @return bool True on success, false otherwise.
     */
    public function exist (int|string $key):bool {

        return $this->offsetExists($key);

    }

    /**
     * ### Gets item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetGet() As offset
     * to retrieve.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->get('firstname');
     *
     * // 'John'
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     *
     * @return null|TValue Item from a collection.
     */
    public function get (int|string $key):mixed {

        return $this->offsetGet($key);

    }

    /**
     * ### Adds or replaces item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetSet() To assign a
     * value to the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->set('Jane', 'firstname');
     * $collection->set('female', 'gender');
     *
     * // ['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']
     * ```
     *
     * @param TValue $value <p>
     * Collection value.
     * </p>
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     *
     * @return void
     */
    public function set (mixed $value, int|string $key):void {

        $this->offsetSet($key, $value);

    }

    /**
     * ### Adds item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetExists() To check
     * whether an offset exists.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetSet() To assign a
     * value to the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->add('female', 'gender');
     *
     * // ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']
     * ```
     *
     * @param TValue $value <p>
     * Collection value.
     * </p>
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyAlreadyExistException If the key already exists in
     * the collection.
     *
     * @return void
     */
    public function add (mixed $value, int|string $key):void {

        !$this->offsetExists($key)
            ? $this->offsetSet($key, $value)
            : throw new KeyAlreadyExistException()->withKey($key);

    }

    /**
     * ### Replaces item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetExists() To check
     * whether an offset exists.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetSet() To assign a
     * value to the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->replace('Jane', 'firstname');
     *
     * // ['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']
     * ```
     *
     * @param TValue $value <p>
     * Collection value.
     * </p>
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist in
     * the collection.
     *
     * @return void
     */
    public function replace (mixed $value, int|string $key):void {

        $this->offsetExists($key)
            ? $this->offsetSet($key, $value)
            : throw new KeyDoesntExistException()->withKey($key);

    }

    /**
     * ### Removes item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetUnset() To unset
     * an offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = Associative::fromArray(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->remove('firstname');
     *
     * // ['lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     *
     * @return void
     */
    public function remove (int|string $key):void {

        $this->offsetUnset($key);

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
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function offsetSet (mixed $offset, mixed $value):void {

        try {

            $this->storage[$offset] = $value;

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
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetExists() Checks
     * whether an offset exists.
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function __isset (int|string $name):bool {

        return $this->offsetExists($name);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetGet() As offset
     * to retrieve.
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function __get (int|string $name):mixed {

        return $this->offsetGet($name);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetSet() To assign a
     * value to the specified offset.
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function __set (int|string $name, mixed $value):void {

        $this->offsetSet($name, $value);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::offsetUnset() To unset
     * an offset.
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     */
    public function __unset (int|string $name):void {

        $this->offsetUnset($name);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param array<TKey, TValue> $data <p>
     * Serialized data.
     * </p>
     */
    public function __unserialize (array $data):void {

        $this->storage = $data;

    }

}
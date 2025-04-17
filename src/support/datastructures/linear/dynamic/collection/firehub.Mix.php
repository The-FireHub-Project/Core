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
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyAlreadyExistException, KeyDoesntExistException, StorageMissingDataException
};
use Generator, Traversable;

use function FireHub\Core\Support\Helpers\Data\toString;

/**
 * ### Mixed collection type
 *
 * Object collection provides a map of mixed data types.
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<TKey, TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Mix extends Collection {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var array<string, array{key: ?TKey, value: TValue}>
     */
    protected array $storage = [];

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {}

    /**
     * ### Create data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = Mix::fromArray([
     *  'one' => ['key' => 'one', 'value' => 1],
     *  'stdClass' => ['key' => stdClass, 'value' => 'two']
     * ]);
     * ```
     * @param array<string, array{key: ?TKey, value: TValue}> $array <p>
     * Data for data structure.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException If $data is missing
     * storage data.
     *
     * @return static<TKey, TValue> Data structure from an array.
     */
    public static function fromArray (array $array):static {

        $storage = new static();

        foreach ($array as $item)
            $storage[
                $item['key']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('key')
            ] = $item['value']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('value');

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = new Mix();
     *
     * $collection['one'] = 1;
     * $collection[new stdClass()] = 'two';
     *
     * $collection->toArray();
     *
     * // [
     * //   'one' => ['key' => 'one', 'value' => 1],
     * //   'stdClass' => ['key' => stdClass, 'value' => 'two']
     * // ]
     * ```
     *
     * @return array<string, array{key: ?TKey, value: TValue}> Data structure data as an array.
     */
    public function toArray ():array {

        return $this->storage;

    }

    /**
     * ### Check if item exist in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetExists() Checks whether
     * an offset exists.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = new Mix();
     *
     * $collection['one'] = 1;
     * $collection[new stdClass()] = 'two';
     *
     * $collection->exist('one');
     *
     * // true
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @return bool True on success, false otherwise.
     */
    public function exist (mixed $key):bool {

        return $this->offsetExists($key);

    }

    /**
     * ### Gets item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetGet() As offset to retrieve.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = new Mix();
     *
     * $collection['one'] = 1;
     * $collection[new stdClass()] = 'two';
     *
     * $collection->get('one');
     *
     * // 1
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @return null|TValue Item from a collection.
     */
    public function get (mixed $key):mixed {

        return $this->offsetGet($key);

    }

    /**
     * ### Adds or replaces item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetSet() To assign a value to the
     * specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = new Mix();
     *
     * $collection['one'] = 1;
     * $collection[new stdClass()] = 'two';
     *
     * $collection->set(2, 'one');
     * $collection->set(3, 'three');
     *
     * // ['one' => 2, new stdClass() => 'two', 'three' => 3]
     * ```
     *
     * @param TValue $value <p>
     * Collection value.
     * </p>
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @return void
     */
    public function set (mixed $value, mixed $key):void {

        $this->offsetSet($key, $value);

    }

    /**
     * ### Adds item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetExists() To check whether
     * an offset exists.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetSet() To assign a value to
     * the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = new Mix();
     *
     * $collection['one'] = 1;
     * $collection[new stdClass()] = 'two';
     *
     * $collection->add('3, 'three');
     *
     * // ['one' => 1, new stdClass() => 'two', 'three' => 3]
     * ```
     *
     * @param TValue $value <p>
     * Collection value.
     * </p>
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyAlreadyExistException If the key already exists in
     * the collection.
     *
     * @return void
     */
    public function add (mixed $value, mixed $key):void {

        !$this->offsetExists($key)
            ? $this->offsetSet($key, $value)
            : throw new KeyAlreadyExistException()->withKey($key);

    }

    /**
     * ### Replaces item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetExists() To check whether
     * an offset exists.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetSet() To assign a value to
     * the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = new Mix();
     *
     * $collection['one'] = 1;
     * $collection[new stdClass()] = 'two';
     *
     * $collection->replace('one', 2);
     *
     * // ['one' => 2, new stdClass() => 'two']
     * ```
     *
     * @param TValue $value <p>
     * Collection value.
     * </p>
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist in
     * the collection.
     *
     * @return void
     */
    public function replace (mixed $value, mixed $key):void {

        $this->offsetExists($key)
            ? $this->offsetSet($key, $value)
            : throw new KeyDoesntExistException()->withKey($key);

    }

    /**
     * ### Removes item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::offsetUnset() To unset an offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
     *
     * $collection = new Mix();
     *
     * $collection['one'] = 1;
     * $collection[new stdClass()] = 'two';
     *
     * $collection->remove('one');
     *
     * // [new stdClass() => 'two']
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @return void
     */
    public function remove (mixed $key):void {

        $this->offsetUnset($key);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetExists (mixed $offset):bool {

        return isset($this->storage[self::key($offset)]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetGet (mixed $offset):mixed {

        return $this->storage[self::key($offset)]['value'];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetSet (mixed $offset, mixed $value):void {

        $this->storage[self::key($offset)] = ['key' => $offset, 'value' => $value];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetUnset (mixed $offset):void {

        unset($this->storage[self::key($offset)]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::yield() To yield key-value.
     */
    public function getIterator ():Traversable {

        yield from $this->yield();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     *
     * @param array<string, array{key: ?TKey, value: TValue}> $data <p>
     * Serialized data.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException If $data is missing
     * storage data.
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    public function __unserialize (array $data):void {

        $storage = [];

        foreach ($data as $item)
            $storage[self::key(
                $item['key']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('key')
            )] = [
                'key' => $item['key'] ?? throw new StorageMissingDataException()->withData($item)->withKey('key'),
                'value' => $item['value'] ?? throw new StorageMissingDataException()->withData($item)->withKey('value')
            ];

        $this->storage = $storage;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param array<string, array{key: ?TKey, value: TValue}> $data <p>
     * Decoded JSON string as an array.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException If $data is missing
     * storage data.
     *
     * @return static<mixed, mixed> Object from JSON encoded parameter.
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    protected static function jsonToObject (array $data):static {

        $storage = new static();

        foreach ($data as $item)
            $storage[
                $item['key']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('key')
            ] = $item['value']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('value');

        return $storage;

    }

    /**
     * ### Get resolved key
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Data\toString() To convert key to string.
     *
     * @param null|TKey $offset <p>
     * Offset to unset.
     * </p>
     *
     * @return string Resolved key.
     */
    private static function key (mixed $offset):string {

        return toString($offset, detailed: true);

    }

    /**
     * ### Yield key-value
     * @since 1.0.0
     *
     * @return Generator Yielded key-value pair.
     */
    private function yield ():Generator {

        foreach ($this->storage as $value)
            yield $value['key'] => $value['value'];

    }

}
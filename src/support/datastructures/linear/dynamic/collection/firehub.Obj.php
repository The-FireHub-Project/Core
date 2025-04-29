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
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use FireHub\Core\Support\Traits\ {
    Jsonable, Serializable
};
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyAlreadyExistException, KeyDoesntExistException, StorageMissingDataException
};
use SplObjectStorage, Traversable;

/**
 * ### Object collection type
 *
 * Object collection provides a map from objects to data or, by ignoring data, an object set.
 * This dual purpose can be useful in many cases involving the need to uniquely identify objects.
 * @since 1.0.0
 *
 * @template TKey of object
 * @template TValue
 *
 * @implements \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<TKey, TValue>
 *
 * @api
 *
 * @phpstan-consistent-constructor
 */
class Obj implements Collection {

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
     * @var SplObjectStorage<TKey, TValue>
     */
    protected SplObjectStorage $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {

        $this->storage = new SplObjectStorage();

    }

    /**
     * ### Create data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $collection = Obj::fromArray([
     *  ['key' => new stdClass, 'value' => 'data for object 1'],
     *  ['key' => new stdClass, 'value' => [1, 2, 3]],
     *  ['key' => new stdClass, 'value' => 20]
     * ]);
     * ```
     *
     * @param array<array{key: TKey, value: TValue}> $array <p>
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
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection = new Obj();
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->toArray();
     *
     * // [
     * //   ['key' => stdClass, 'value' => 'data for object 1'],
     * //   ['key' => stdClass, 'value' => [1, 2, 3]],
     * //   ['key' => stdClass, 'value' => 20]
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
     * ### Check if item exist in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetExists() Checks whether
     * an offset exists.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection = new Obj();
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->exist($cls1);
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
    public function exist (object $key):bool {

        return $this->offsetExists($key);

    }

    /**
     * ### Gets item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetGet() As offset to retrieve.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection = new Obj();
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->get($cls1);
     *
     * // 'data for object 1'
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist in
     * the collection.
     *
     * @return null|TValue Item from a collection.
     */
    public function get (object $key):mixed {

        return $this->offsetExists($key)
            ? $this->offsetGet($key)
            : throw new KeyDoesntExistException()->withKey($key);

    }

    /**
     * ### Adds or replaces item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetSet() To assign a value to
     * the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection = new Obj();
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->set('the data for object 1', $cls1);
     *
     * // [
     *      ['object' => object(stdClass), 'info' => 'the data for object 1'],
     * //   ['object' => object(stdClass), 'info' => [1,2,3]],
     * //   ['object' => object(stdClass), 'info' => 20]
     * // ]
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
    public function set (mixed $value, object $key):void {

        $this->offsetSet($key, $value);

    }

    /**
     * ### Adds item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetExists() To check whether
     * an offset exists.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetSet() To assign a value to
     * the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection = new Obj();
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->add('the data for object 4', new stdClass());
     *
     * // [
     *      ['object' => object(stdClass), 'info' => 'data for object 1'],
     * //   ['object' => object(stdClass), 'info' => [1,2,3]],
     * //   ['object' => object(stdClass), 'info' => 20],
     * //   ['object' => object(stdClass), 'info' => 'the data for object 4']
     * // ]
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
    public function add (mixed $value, object $key):void {

        !$this->offsetExists($key)
            ? $this->offsetSet($key, $value)
            : throw new KeyAlreadyExistException()->withKey($key);

    }

    /**
     * ### Replaces item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetExists() To check whether
     * an offset exists.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetSet() To assign a value to
     * the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection = new Obj();
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->replace('the data for object 1', $cls1);
     *
     * // [
     *      ['object' => object(stdClass), 'info' => 'the data for object 1'],
     * //   ['object' => object(stdClass), 'info' => [1,2,3]],
     * //   ['object' => object(stdClass), 'info' => 20]
     * // ]
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
    public function replace (mixed $value, object $key):void {

        $this->offsetExists($key)
            ? $this->offsetSet($key, $value)
            : throw new KeyDoesntExistException()->withKey($key);

    }

    /**
     * ### Removes item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::offsetUnset() To unset an offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     * $cls2 = new stdClass();
     * $cls3 = new stdClass();
     *
     * $collection = new Obj();
     * $collection[$cls1] = 'data for object 1';
     * $collection[$cls2] = [1,2,3];
     * $collection[$cls3] = 20;
     *
     * $collection->remove($cls1);
     *
     * // [
     * //   ['object' => object(stdClass), 'info' => [1,2,3]],
     * //   ['object' => object(stdClass), 'info' => 20]
     * // ]
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @return void
     */
    public function remove (object $key):void {

        $this->offsetUnset($key);

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

        foreach ($this->storage as $object)
            yield $object => $this->storage[$object];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::toArray() To get data structure
     * an array.
     *
     * @return array<array{key: TKey, value: TValue}> Data which can be serialized by json_encode(), which is a value
     * of any type other than a
     * resource.
     */
    public function jsonSerialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::toArray() To get data structure
     * an array.
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
     * @param array<array{key: TKey, value: TValue}> $data <p>
     * Serialized data.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException If $data is missing
     * storage data.
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    public function __unserialize (array $data):void {

        $storage = new SplObjectStorage();

        foreach ($data as $item)
            $storage[
                $item['key']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('key')
            ] = $item['value']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('value');

        $this->storage = $storage; // @phpstan-ignore assign.propertyType

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param array<array{key: TKey, value: TValue}> $data <p>
     * Decoded JSON string as an array.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException If $data is missing
     * storage data.
     *
     * @return static<object, mixed> Object from JSON encoded parameter.
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

}
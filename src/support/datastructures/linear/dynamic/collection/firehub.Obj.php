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
use FireHub\Core\Support\Traits\ {
    Jsonable, Serializable
};
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyDoesntExistException, StorageMissingDataException
};
use FireHub\Core\Support\LowLevel\Iterator;
use SplObjectStorage, Traversable, UnexpectedValueException;

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
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<TKey, TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Obj extends Collection {

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
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::attach() To add an object
     * in the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $array = [
     *  ['key' => new stdClass, 'value' => 'data for object 1'],
     *  ['key' => new stdClass, 'value' => [1, 2, 3]],
     *  ['key' => new stdClass, 'value' => 20]
     * ];
     *
     * $collection = Obj::fromArray($array);
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
     *
     * @phpstan-ignore method.childParameterType
     */
    public static function fromArray (array $array):static {

        $storage = new static();

        foreach ($array as $item)
            $storage->attach(
                $item['key']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('key'),
                $item['value']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('value')
            );

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
     * $collection->attach($cls1, 'data for object 1');
     * $collection->attach($cls2, [1,2,3]);
     * $collection->attach($cls3, 20);
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
     * @uses \FireHub\Core\Support\LowLevel\Iterator::count() To count storage items.
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
     * $collection->attach($cls1, 'data for object 1');
     * $collection->attach($cls2, [1,2,3]);
     * $collection->attach($cls3, 20);
     *
     * $collection->count();
     *
     * // 3
     * ```
     */
    public function count ():int {

        return Iterator::count($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::attach() To add an object
     * in the storage.
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
     * $collection->attach($cls1, 'data for object 1');
     * $collection->attach($cls2, [1,2,3]);
     * $collection->attach($cls3, 20);
     *
     * $new_collection = $collection->apply(fn($info, $object) => $object !== $cls3 ? $info : $info + 1);
     * ```
     */
    public function apply (callable $callback):static {

        $storage = new static();

        foreach ($this as $object => $info)
            $storage->attach($object, $callback($info, $object));

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Merge a new data structure into the current one
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::attach() To add an object
     * in the storage.
     *
     * @template TMergeKey of object
     * @template TMergeValue
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
     * $collection->attach($cls1, 'data for object 1');
     * $collection->attach($cls2, [1,2,3]);
     *
     * $collection2 = new Obj();
     * $collection2->attach($cls3, 20);
     *
     * $merged = $collection->merge($collection2);
     * ```
     *
     * @param self<TMergeKey, TMergeValue> ...$data_structures <p>
     * Data structures to merge.
     * </p>
     *
     * @return static<TKey|TMergeKey, TValue|TMergeValue> New merged data structure.
     */
    public function merge (self ...$data_structures):static {

        $storage = new static();

        foreach ($this as $object => $info)
            $storage->attach($object, $info);

        foreach ($data_structures as $data_structure)
            foreach ($data_structure as $object => $info)
                $storage->attach($object, $info);

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Checks if an object exists in the storage
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     *
     * $collection = new Obj();
     *
     * $collection->attach($cls1, 'data for object 1');
     *
     * $collection->exist($cls1);
     *
     * // true
     * ```
     *
     * @param TKey $object <p>
     * The object to check.
     * </p>
     *
     * @return bool True if the object is in the storage, false otherwise.
     */
    public function exist (object $object):bool {

        return $this->storage->contains($object);

    }

    /**
     * ### Gets an object from the storage
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     *
     * $collection = new Obj();
     *
     * $collection->attach($cls1, 'data for object 1');
     *
     * $collection->get($cls1);
     *
     * // 'data for object 1'
     * ```
     *
     * @param TKey $object <p>
     * Object to get.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist
     * in the collection.
     *
     * @return TValue The data previously associated with the object in the storage.
     */
    public function get (object $object):mixed {

        try {

            return $this->storage->offsetGet($object);

        } catch (UnexpectedValueException) {

            throw new KeyDoesntExistException()->withKey($object);

        }

    }

    /**
     * ### Adds an object in the storage
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     *
     * $collection = new Obj();
     *
     * $collection->attach($cls1, 'data for object 1');
     *
     * // [
     * //   ['key' => stdClass, 'value' => 'data for object 1']
     * // ]
     * ```
     *
     * @param TKey $object <p>
     * The object to add.
     * </p>
     * @param TValue $data <p>
     * The data to associate with the object.
     * </p>
     *
     * @return void
     */
    public function attach (object $object, mixed $data = null):void {

        $this->storage->attach($object, $data);

    }

    /**
     * ### Removes an object from the storage
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj;
     *
     * $cls1 = new stdClass();
     *
     * $collection = new Obj();
     *
     * $collection->attach($cls1, 'data for object 1');
     *
     * $collection->detach($cls1);
     * ```
     *
     * @param TKey $object <p>
     * The object to remove.
     * </p>
     *
     * @return void
     */
    public function detach (object $object):void {

        $this->storage->detach($object);

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
            $storage->attach(
                $item['key']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('key'),
                $item['value']
                ?? throw new StorageMissingDataException()->withData($item)->withKey('value')
            );

        $this->storage = $storage; // @phpstan-ignore assign.propertyType

    }

}
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
use FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException;
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
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<TKey, TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Obj extends Collection {

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
     * ### Create a data structure from an array
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\StorageMissingDataException If $data is missing in the
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
     * ### Checks if an object exists in the collection
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
     * $collection->has($cls1);
     *
     * // true
     * ```
     *
     * @param TKey $object <p>
     * The object to add.
     * </p>
     *
     * @return bool if the object exists is in the collection, false otherwise.
     */
    public function has (object $object):bool {

        return $this->storage->contains($object);

    }

    /**
     * ### Adds an object to the collection
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
     * ### Removes an object from the collection
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
     * $array = $collection->toArray();
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
     */
    public function getIterator ():Traversable {

        foreach ($this->storage as $object)
            yield $object => $this->storage[$object];

    }

}
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

namespace FireHub\Core\Support\DataStructures\Linear;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed as FixedContract;
use FireHub\Core\Support\Contracts\ArrayAccessible;
use FireHub\Core\Support\DataStructures\DataStructure;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    CannotAccessOffsetException, KeyOutOfBoundsException
};
use FireHub\Core\Support\LowLevel\ {
    Iterables, Iterator
};
use Closure, OutOfBoundsException, SplFixedArray, Traversable, TypeError;

/**
 * ### Fixed data structure type
 *
 * Fixed data structure allows only integers as keys, but it is faster and uses less memory than an array collection.
 * This collection type must be resized manually and allows only integers within the range as indexes.
 * @since 1.0.0
 *
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\DataStructure<int, ?TValue>
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed<int, ?TValue>
 * @implements \FireHub\Core\Support\Contracts\ArrayAccessible<int, ?TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Fixed extends DataStructure implements FixedContract, ArrayAccessible {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var SplFixedArray<TValue>
     */
    protected SplFixedArray $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param positive-int $size <p>
     * Size of the data structure.
     * </p>
     * @param null|Closure(SplFixedArray<mixed>):void $storage [optional] <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     */
    public function __construct (int $size, ?Closure $storage = null) {

        $fixed = new SplFixedArray($size);

        if(isset($storage)) $storage($fixed);

        $this->storage = $fixed; // @phpstan-ignore assign.propertyType

    }

    /**
     * ### Create data structure from an array
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count array parameter items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = Obj::fromArray(['one', 'two', 'three']);
     * ```
     *
     * @param array<int, null|TValue> $array <p>
     * Data for data structure.
     * </p>
     *
     * @return static<TValue> Data structure from an array.
     */
    public static function fromArray (array $array):static {

        return new static(Iterables::count($array), function (SplFixedArray $storage) use ($array) { // @phpstan-ignore return.type

            $i = 0;
            foreach ($array as $item)
                $storage[$i++] = $item;

        });

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->toArray();
     *
     * // ['one', 'two', 'three']
     * ```
     *
     * @return array<int, null|TValue> Data structure data as an array.
     */
    public function toArray ():array {

        return Iterator::toArray($this);

    }

    /**
     * ### Check if item exist in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::offsetExists() Checks whether
     * an offset exists.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->exist(0);
     *
     * // true
     * ```
     *
     * @param int $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     *
     * @return bool True on success, false otherwise.
     */
    public function exist (int $key):bool {

        return $this->offsetExists($key);

    }

    /**
     * ### Gets item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::offsetGet() As offset to retrieve.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->get(0);
     *
     * // 'one'
     * ```
     *
     * @param int $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if the key is out of bounds.
     *
     * @return null|TValue Item from a collection.
     */
    public function get (int $key):mixed {

        return $this->offsetGet($key);

    }

    /**
     * ### Adds or replaces item in collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::offsetSet() To assign a value to the specified offset.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->set(1, 0);
     *
     * // [0 => 1, 1 => 'two', 2 => 'three']
     * ```
     *
     * @param TValue $value <p>
     * Collection value.
     * </p>
     * @param int $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if the key is out of bounds.
     *
     * @return void
     */
    public function set (mixed $value, int $key):void {

        $this->offsetSet($key, $value);

    }

    /**
     * ### Removes item from collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Fixed::offsetUnset() To unset an offset.
     *
     * @example
     * ```php
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $collection->remove(2);
     *
     * // [0 => 'one', 1 => 'two']
     * ```
     *
     * @param int $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if the key is out of bounds.
     *
     * @return void
     */
    public function remove (int $key):void {

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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if the key is out of bounds.
     */
    public function offsetGet (mixed $offset):mixed {

        try {

            return $this->storage[$offset];

        } catch (TypeError) {

            throw new CannotAccessOffsetException()->withValue($offset);

        } catch (OutOfBoundsException) {

            throw new KeyOutOfBoundsException()->withKey($offset);

        }

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if the key is out of bounds.
     */
    public function offsetSet (mixed $offset, mixed $value):void {

        try {

            $this->storage[$offset] = $value;

        } catch (TypeError) {

            throw new CannotAccessOffsetException()->withValue($offset);

        } catch (OutOfBoundsException) {

            throw new KeyOutOfBoundsException()->withKey($offset);

        }

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException If the key is out of bounds.
     */
    public function offsetUnset (mixed $offset):void {

        try {

            unset($this->storage[$offset]);

        } catch (TypeError) {

            throw new CannotAccessOffsetException()->withValue($offset);

        } catch (OutOfBoundsException) {

            throw new KeyOutOfBoundsException()->withKey($offset);

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
     */
    public function jsonSerialize ():array {

        return $this->storage->jsonSerialize();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __serialize ():array {

        return $this->storage->jsonSerialize();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count array parameter items.
     *
     * @param array<int, null|TValue> $data <p>
     * Serialized data.
     * </p>
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    public function __unserialize (array $data):void {

        $storage = new SplFixedArray(Iterables::count($data));

        $i = 0;
        foreach ($data as $item)
            $storage[$i++] = $item;

        $this->storage = $storage; // @phpstan-ignore assign.propertyType

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count array parameter items.
     *
     * @param array<int, null|TValue> $data <p>
     * Decoded JSON string as an array.
     * </p>
     *
     * @return static<mixed> Object from JSON encoded parameter.
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    protected static function jsonToObject (array $data):static {

        $storage = new static(Iterables::count($data));

        $i = 0;
        foreach ($data as $item)
            $storage[$i++] = $item;

        return $storage;

    }

}
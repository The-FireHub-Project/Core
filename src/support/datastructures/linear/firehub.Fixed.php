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
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    CannotAccessOffsetException, KeyOutOfBoundsException
};
use FireHub\Core\Support\LowLevel\Iterator;
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
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed<int, ?TValue>
 * @implements \FireHub\Core\Support\Contracts\ArrayAccessible<int, ?TValue>
 *
 * @api
 */
class Fixed implements FixedContract, ArrayAccessible {

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
     * ### Get data structure data as an array
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if key is out of bounds.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if key is out of bounds.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if key is out of bounds.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if key is out of bounds.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if key is out of bounds.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyOutOfBoundsException if key is out of bounds.
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

}
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
use FireHub\Core\Support\LowLevel\ {
    Iterables, Iterator
};
use SplFixedArray;

/**
 * ### Fixed data structure type
 *
 * Fixed data structure allows only integers as keys, but it is faster and uses less memory than an array collection.
 * This collection type must be resized manually and allows only integers within the range as indexes.
 * @since 1.0.0
 *
 * @template TValue
 *
 * @extends SplFixedArray<TValue>
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed<int, ?TValue>
 * @implements \FireHub\Core\Support\Contracts\ArrayAccessible<int, ?TValue>
 *
 * @api
 *
 * @phpstan-consistent-constructor
 */
class Fixed extends SplFixedArray implements FixedContract, ArrayAccessible {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param non-negative-int $size <p>
     * Size of the data structure.
     * </p>
     *
     * @return void
     */
    public function __construct (int $size) {

        parent::__construct($size);

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
     * @param bool $preserve_keys [optional] <p>
     * Try to save the numeric indexes used in the original array.
     * </p>
     *
     * @return static<TValue> Data structure from an array.
     */
    public static function fromArray (array $array, bool $preserve_keys = false):static {

        $storage = new static(Iterables::count($array));

        if ($preserve_keys) {

            foreach ($array as $key => $item)
                $storage[$key] = $item;

        } else {

            $i = 0;

            foreach ($array as $item)
                $storage[$i++] = $item;

        }

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Get the size of the data structure
     * @since 1.0.0
     *
     * @return non-negative-int Size of the data structure.
     */
    public function getSize ():int {

        return parent::getSize() > 0 ? parent::getSize() : 0;

    }

    /**
     * ### Change the size of the data structure
     * @since 1.0.0
     *
     * @param non-negative-int $size <p>
     * Size of the data structure.
     * </p>
     *
     * @return true Always true.
     *
     * @phpstan-ignore-next-line method.childParameterType
     */
    public function setSize (int $size):true {

        return parent::setSize($size); // @phpstan-ignore return.type

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
     * @return void
     */
    public function remove (int $key):void {

        $this->offsetUnset($key);

    }

}
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
    CannotAccessOffsetException, KeyAlreadyExistException, KeyDoesntExistException
};
use Closure, UnexpectedValueException, SplObjectStorage, Traversable, TypeError;

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
     * @param null|Closure(SplObjectStorage<object, mixed>):void $storage [optional] <p>
     * Underlying storage data.
     * </p>
     *
     * @return void
     */
    public function __construct (?Closure $storage = null) {

        $object = new SplObjectStorage();

        if(isset($storage)) $storage($object);

        $this->storage = new SplObjectStorage();

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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
     *
     * @return null|TValue Item from a collection.
     */
    public function get (object $key):mixed {

        return $this->offsetGet($key);

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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
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
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\CannotAccessOffsetException If data structure can't
     * access offset.
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

        } catch (UnexpectedValueException) {

            return null;

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

        foreach ($this->storage as $object)
            yield $object => $this->storage[$object];

    }

}
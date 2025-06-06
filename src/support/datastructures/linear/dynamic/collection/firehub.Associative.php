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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Contracts\ {
    Arrayable, Flippable, KeyChangeable, Overloadable
};
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\DataStructures\Exceptions\ {
    KeyAlreadyExistException, KeyDoesntExistException
};
use FireHub\Core\Support\LowLevel\Arr;

use function FireHub\Core\Support\Helpers\Arr\ {
    random, shuffle
};

/**
 * ### Associative array collection type
 *
 * Collections that use named keys that you assign to them.
 * @since 1.0.0
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage<TKey, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Arrayable<TKey, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Flippable<TKey, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\KeyChangeable<TKey, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Overloadable<TKey, TValue>
 *
 * @api
 */
class Associative extends ArrStorage implements Arrayable, Flippable, KeyChangeable, Overloadable {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct (array $storage = []) {

        $this->storage = $storage;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public static function fromDataStructure (DataStructures $data_structure):static {

        $storage = [];

        foreach ($data_structure as $key => $value)
            $storage[$key] = $value;

        return new static($storage);

    }

    /**
     * ### Create a data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $array = ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2];
     *
     * $collection = Associative::fromArray($array);
     * ```
     *
     * @param array<TKey, TValue> $array <p>
     * Data for data structure.
     * </p>
     *
     * @return static<TKey, TValue> Data structure from an array.
     */
    public static function fromArray (array $array):static {

        return new static($array);

    }

    /**
     * ### Check if item exist in the collection
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $exist = $collection->exist('firstname');
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
    public function exist (int|string $key):bool {

        return isset($this->storage[$key]);

    }

    /**
     * ### Gets an item from the collection
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $firstname = $collection->get('firstname');
     *
     * // 'John'
     * ```
     * @example With a non-existing key
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $gender = $collection->get('gender');
     *
     * // null
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @return null|TValue Item from a collection, or null if an item with a provided key doesn't exist.
     */
    public function get (int|string $key):mixed {

        return $this->storage[$key];

    }

    /**
     * ### Takes an item from the collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::exist() To check if item
     * exist in a collection.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::get() To get an item from
     * the collection.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $firstname = $collection->take('firstname');
     *
     * // 'John'
     * ```
     * @example With a non-existing key
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $gender = $collection->take('gender');
     *
     * // Error
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist in
     * the collection.
     *
     * @return TValue Item from a collection.
     */
    public function take (int|string $key):mixed {

        return $this->exist($key) // @phpstan-ignore return.type
            ? $this->get($key)
            : throw new KeyDoesntExistException()->withKey($key);

    }

    /**
     * ### Remove and takes an item from the collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::take() To take an item from
     * the collection.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::remove() To remove an item from
     * the collection.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $firstname = $collection->pull('firstname');
     *
     * // 'John'
     * ```
     * @example With a non-existing key
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $gender = $collection->pull('gender');
     *
     * // Error
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist in
     * the collection.
     *
     * @return TValue Item from a collection.
     */
    public function pull (int|string $key):mixed {

        $value = $this->take($key);

        $this->remove($key);

        return $value;

    }

    /**
     * ### Adds or replaces item in the collection
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
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
     * @return void
     */
    public function set (mixed $value, int|string $key):void {

        $this->storage[$key] = $value;

    }

    /**
     * ### Adds an item to the collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::exist() To check if item
     * exist in a collection.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::set() To set an item in
     * the collection.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->add('female', 'gender');
     *
     * // ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']
     * ```
     * @example With an existing key
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->add('Jane', 'firstname');
     *
     * // Error
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
    public function add (mixed $value, int|string $key):void {

        !$this->exist($key)
            ? $this->set($value, $key)
            : throw new KeyAlreadyExistException()->withKey($key);

    }

    /**
     * ### Replaces an item in the collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::exist() To check if item
     * exist in a collection.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::set() To set an item in
     * the collection.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->replace('Jane', 'firstname');
     *
     * // ['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']
     * ```
     * @example With an existing key
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->replace('female', 'gender');
     *
     * // Error
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
    public function replace (mixed $value, int|string $key):void {

        $this->exist($key)
            ? $this->set($value, $key)
            : throw new KeyDoesntExistException()->withKey($key);

    }

    /**
     * ### Removes an item from the collection
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
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
     * @return void
     */
    public function remove (int|string $key):void {

        unset($this->storage[$key]);

    }

    /**
     * ### Deletes an item from the collection
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::exist() To check if item
     * exist in a collection.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::set() To set an item in
     * the collection.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->delete('firstname');
     *
     * // ['lastname' => 'Doe', 'age' => 25, 10 => 2, 'gender' => 'female']
     * ```
     * @example With an existing key
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->delete('gender');
     *
     * // Error
     * ```
     *
     * @param TKey $key <p>
     * Collection key.
     * </p>
     *
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist in
     * the collection.
     *
     * @return void
     */
    public function delete (int|string $key):void {

        $this->exist($key)
            ? $this->remove($key)
            : throw new KeyDoesntExistException()->withKey($key);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\random() To pick one or more random values out of the array.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $random = $collection->random($collection2);
     *
     * // ['Doe']
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException If an array is empty, or if the number is
     * out of range.
     */
    public function random (int $number = 1):mixed {

        $result = random($this->storage, $number, true);

        return $number > 1
            ? new static($result) // @phpstan-ignore argument.type
            : $result;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::applyToKeys() To create new
     * data structure with applied callback to the keys of the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->transformKeys(fn($value, $key) => $value.'.');
     *
     * // ['firstname.' => 'John', 'lastname.' => 'Doe', 'age.' => 25, '10.' => 2]
     * ```
     */
    public function transformKeys (callable $callback):self {

        $this->storage = $this->applyToKeys($callback)->toArray();

        return $this;

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
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $applyToKeys = $collection->applyToKeys(fn($value, $key) => $value.'.');
     *
     * // ['firstname.' => 'John', 'lastname.' => 'Doe', 'age.' => 25, '10.' => 2]
     * ```
     */
    public function applyToKeys (callable $callback):static {

        $storage = [];

        foreach ($this->storage as $key => $value) $storage[$callback($value, $key)] = $value;

        return new static($storage);

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
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $filter = $collection->filter(fn($value, $key) => $key !== 'lastname');
     *
     * // ['firstname' => 'John', 'age' => 25, 10 => 2]
     * ```
     */
    public function filter (callable $callback):static {

        $storage = [];

        foreach ($this->storage as $key => $value) {

            $result = $callback($value, $key);

            if ($result === 'break') break;
            if ($result) $storage[$key] = $value;

        }

        return new static($storage);

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
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $chunk = $collection->chunkWhere(fn($value, $key) => $value === 'Doe');
     *
     * // [['firstname' => 'John', 'lastname' => 'Doe'], ['age' => 25, 10 => 2]]
     * ```
     */
    public function chunkWhere (callable $callback):Lazy {

        return new Lazy(function () use ($callback) {

            $chunks = [];
            foreach ($this as $key => $value) {

                $chunks[$key] = $value;

                if ($callback($value, $key)) {

                    yield new static($chunks);

                    $chunks = [];

                }

            }

            if ($chunks) yield new static($chunks);

        });

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::reverse() To reverse the order of array items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $reverse = $collection->reverse($collection2);
     *
     * // [10 => 2, 'age' => 25, 'lastname' => 'Doe', 'firstname' => 'John']
     * ```
     */
    public function reverse ():static {

        return new static(Arr::reverse($this->storage, true));

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\shuffle() To shuffle the array items with keys preserved.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $shuffle = $collection->shuffle();
     *
     * // [10 => 2, 'lastname' => 'Doe', 'age' => 25, 'firstname' => 'John']
     * ```
     */
    public function shuffle ():static {

        $storage = $this->storage;

        shuffle($storage);

        return new static($storage);

    }

    /**
     * ### Merge a new data structure into the current one
     * @since 1.0.0
     *
     * @template TMergedKey of array-key
     * @template TMergedValue
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * $collection2 = new Associative(['firstname' => 'Jane', 'middlename' => 'Marry']);
     *
     * $merge = $collection->merge($collection2);
     *
     * // ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'middlename' => 'Marry']
     * ```
     *
     * @param \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<TMergedKey, TMergedValue> ...$data_structures <p>
     * List of data structures to merge.
     * </p>
     *
     * @return static<TKey|TMergedKey, TValue|TMergedValue> New merged data structure.
     */
    public function merge (self ...$data_structures):static {

        $storage = $this->storage;

        foreach ($data_structures as $data_structure)
            $storage += $data_structure->storage;

        return new static($storage);

    }

    /**
     * ### Union a new data structure into the current one
     * @since 1.0.0
     *
     * @template TMergedKey of array-key
     * @template TMergedValue
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     * $collection2 = new Associative(['firstname' => 'Jane', 'middlename' => 'Marry']);
     *
     * $union = $collection->union($collection2);
     *
     * // ['firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 25, 10 => 2, 'middlename' => 'Marry']
     * ```
     *
     * @param \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<TMergedKey, TMergedValue> ...$data_structures <p>
     * List of data structures to union.
     * </p>
     *
     * @return static<TKey|TMergedKey, TValue|TMergedValue> New union data structure.
     */
    public function union (self ...$data_structures):static {

        $storage = [];

        foreach ($data_structures as $data_structure)
            $storage = $data_structure->storage + $storage;

        return new static($storage + $this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function flip ():static {

        return new static(Arr::flip($this->storage)); // @phpstan-ignore argument.type, argument.templateType

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::exist() To check if item exist
     * in the collection.
     */
    public function __isset (int|string $name):bool {

        return $this->exist($name);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::get() To get an item from the
     * collection.
     */
    public function __get (int|string $name):mixed {

        return $this->get($name);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::set() To add or replaces item
     * in the collection.
     */
    public function __set (int|string $name, mixed $value):void {

        $this->set($value, $name);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::remove() To remove an item
     * from
     * the collection.
     */
    public function __unset (int|string $name):void {

        $this->remove($name);

    }

}
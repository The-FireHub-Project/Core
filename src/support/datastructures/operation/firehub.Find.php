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

namespace FireHub\Core\Support\DataStructures\Operation;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage;
use FireHub\Core\Support\LowLevel\Arr;

/**
 * ### Find operations for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\Contracts\HighLevel\DataStructures
 */
readonly class Find {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures As parameter.
     *
     * @param TDataStructure $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected DataStructures $data_structure
    ) {}

    /**
     * ### Searches the data structure for a given value and returns the first corresponding key if successful
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::search() As ArrayableStorage method.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Find::firstKey() To search for the first key satisfying
     * a callback function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new Find($collection)->key('Doe');
     *
     * // 'lastname'
     * ```
     *
     * @param value-of<TDataStructure> $by_value <p>
     * The searched value.
     * If the value is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return null|key-of<TDataStructure> The key if it is found in the data structure, null otherwise. If a value is
     * found in a data structure more than once, the first matching key is returned.
     */
    public function key (mixed $by_value):mixed {

        if ($this->data_structure instanceof ArrStorage)
            return Arr::search($by_value, $this->data_structure->toArray()) ?: null; // @phpstan-ignore return.type

        return $this->firstKey(fn($value, $key) => $value === $by_value);

    }

    /**
     * ### Searches the data structure for a given key and returns the first corresponding value if successful
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Find::first() To search for the first value satisfying
     * a callback function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new Find($collection)->value('lastname');
     *
     * // 'Doe'
     * ```
     *
     * @param key-of<TDataStructure> $by_key <p>
     * The searched key.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return null|value-of<TDataStructure> The value if it is found in the data structure, null otherwise. If a key
     * is found in a data structure more than once, the first matching value is returned.
     */
    public function value (mixed $by_key):mixed {

        return $this->first(fn($value, $key) => $key === $by_key);

    }

    /**
     * ### Searches for the first value satisfying a callback function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::find() As ArrayableStorage method.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $value = new Find($collection)->first(fn($value, $key) => $key !== 'firstname');
     *
     * // 'lastname'
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|value-of<TDataStructure> The value if it is found in the data structure, null otherwise.
     * If a callback is valid in a data structure more than once, the first matching value is returned.
     */
    public function first (callable $callback):mixed {

        if ($this->data_structure instanceof ArrStorage)
            return Arr::find($this->data_structure->toArray(), $callback); // @phpstan-ignore argument.type

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) return $storage_value;

        return null;

    }

    /**
     * ### Searches for the first key satisfying a callback function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::findKey() As ArrayableStorage method.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $key = new Find($collection)->firstKey(fn($value, $key) => $value !== 'John');
     *
     * // 'lastname'
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|key-of<TDataStructure> The key if it is found in the data structure, null otherwise. If a callback
     * is valid in a data structure more than once, the first matching value is returned.
     */
    public function firstKey (callable $callback):mixed {

        if ($this->data_structure instanceof ArrStorage)
            return Arr::findKey($this->data_structure->toArray(), $callback); // @phpstan-ignore argument.type

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) return $storage_key;

        return null;

    }

    /**
     * ### Searches for the last value satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $value = new Find($collection)->last(fn($value, $key) => $key !== 10);
     *
     * // 25
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|value-of<TDataStructure> The value if it is found in the data structure, null otherwise.
     * If a callback is valid in a data structure more than once, the last matching value is returned.
     */
    public function last (callable $callback):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) $result = $storage_value;

        return $result ?? null;

    }

    /**
     * ### Searches for the last key satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $key = new Find($collection)->lastKey(fn($value, $key) => $value !== 2);
     *
     * // 'age'
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|key-of<TDataStructure> The key if it is found in the data structure, null otherwise. If a callback
     * is valid in a data structure more than once, the last matching value is returned.
     */
    public function lastKey (callable $callback):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) $result = $storage_key;

        return $result ?? null;

    }

    /**
     * ### Searches for the first value before satisfying a callback function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Find::beforeWhere() To search for the first value before
     * satisfying a callback function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $value = new Find($collection)->before('Doe');
     *
     * // 'John'
     * ```
     *
     * @param value-of<TDataStructure> $search <p>
     * The searched value.
     * If the value is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return null|value-of<TDataStructure> The value after if it is found in the data structure, null otherwise.
     * If a callback is valid in a data structure more than before, the first matching value is returned.
     */
    public function before (mixed $search):mixed {

        return $this->beforeWhere(fn($value) => $search === $value);

    }

    /**
     * ### Searches for the first value before satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $value = new Find($collection)->beforeWhere(fn($value, $key) => $value === 'Doe');
     *
     * // 'John'
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|value-of<TDataStructure> The value before if it is found in the data structure, null otherwise.
     * If a callback is valid in a data structure more than once, the first matching value is returned.
     */
    public function beforeWhere (callable $callback):mixed {

        $found = null;
        foreach ($this->data_structure as $storage_key => $storage_value) {

            if ($callback($storage_value, $storage_key)) break;

            $found = $storage_value;

        }

        return $found;

    }

    /**
     * ### Searches for the first value after satisfying a callback function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Find::afterWhere() To search for the first value after
     * satisfying a callback function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $value = new Find($collection)->after('Doe');
     *
     * // 25
     * ```
     *
     * @param value-of<TDataStructure> $search <p>
     * The searched value.
     * If the value is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return null|value-of<TDataStructure> The value after if it is found in the data structure, null otherwise.
     * If a callback is valid in a data structure more than after, the first matching value is returned.
     */
    public function after (mixed $search):mixed {

        return $this->afterWhere(fn($value) => $search === $value);

    }

    /**
     * ### Searches for the first value after satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $value = new Find($collection)->afterWhere(fn($value, $key) => $value === 'Doe');
     *
     * // 25
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|value-of<TDataStructure> The value after if it is found in the data structure, null otherwise.
     * If a callback is valid in a data structure more than once, the first matching value is returned.
     */
    public function afterWhere (callable $callback):mixed {

        $found = false;
        foreach ($this->data_structure as $storage_key => $storage_value) {

            if ($found) return $storage_value;

            if ($callback($storage_value, $storage_key)) $found = true;

        }

        return null;

    }

}
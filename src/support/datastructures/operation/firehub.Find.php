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

/**
 * ### Find operations for data structures
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class Find {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures As parameter.
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue> $data_structure <p>
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
     * @param mixed $value <p>
     * The searched value.
     * If the value is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return null|TKey The key if it is found in the data structure, null otherwise. If a value is found in a
     * data structure more than once, the first matching key is returned.
     */
    public function key (mixed $value):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($value === $storage_value) return $storage_key;

        return null;

    }

    /**
     * ### Searches the data structure for a given key and returns the first corresponding value if successful
     * @since 1.0.0
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
     * @param mixed $key <p>
     * The searched key.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return null|TValue The value if it is found in the data structure, null otherwise. If a key is found in a
     * data structure more than once, the first matching value is returned.
     */
    public function value (mixed $key):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($key === $storage_key) return $storage_value;

        return null;

    }

    /**
     * ### Returns the first element satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new Find($collection)->first(fn($value, $key) => $key !== 'firstname');
     *
     * // 'Doe'
     * ```
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|TValue The value if it is found in the data structure, null otherwise. If a callback is valid in a
     * data structure more than once, the first matching value is returned.
     */
    public function first (callable $callback):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) return $storage_value;

        return null;

    }

    /**
     * ### Returns the first key satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new Find($collection)->firstKey(fn($value, $key) => $value !== 'John');
     *
     * // 'lastname'
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|TKey The key if it is found in the data structure, null otherwise. If a callback is valid in a
     * data structure more than once, the first matching key is returned.
     */
    public function firstKey (callable $callback):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) return $storage_key;

        return null;

    }

    /**
     * ### Returns the last value satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new Find($collection)->last(fn($value, $key) => $key !== 10);
     *
     * // 25
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|TValue The value if it is found in the data structure, null otherwise. If a callback is valid in a
     * data structure more than once, the last matching value is returned.
     */
    public function last (callable $callback):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) $result = $storage_value;

        return $result ?? null;

    }

    /**
     * ### Returns the last key satisfying a callback function
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Find;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new Find($collection)->lastKey(fn($value, $key) => $value !== 2);
     *
     * // 'age'
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * The callback function to call to check each element.
     * </p>
     *
     * @return null|TKey The key if it is found in the data structure, null otherwise. If a callback is valid in a
     * data structure more than once, the last matching key is returned.
     */
    public function lastKey (callable $callback):mixed {

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) $result = $storage_key;

        return $result ?? null;

    }

}
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
use FireHub\Core\Support\Enums\Data\Type;
use FireHub\Core\Support\LowLevel\ {
    Arr, Data, DataIs
};

/**
 * ### Contains operations for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\Contracts\HighLevel\DataStructures
 */
readonly class Contains {

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
     * ### Determines whether a data structure contains a given key
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::int() To check if the given key is an integer.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To check if the given key is a string.
     * @uses \FireHub\Core\Support\LowLevel\Arr::keyExist() To check if the given key or index exists in the array.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::where() To check if a value exists
     * in data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Contains($collection)->key('firstname');
     *
     * // true
     * ```
     *
     * @param key-of<TDataStructure> $search <p>
     * The searched key.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return bool True if a data structure contains a provided key, false otherwise.
     */
    public function key (mixed $search):bool {

        if ($this->data_structure instanceof ArrStorage && (DataIs::int($search) || DataIs::string($search)))
            return Arr::keyExist($search, $this->data_structure->toArray());

        return $this->where(fn($value, $key) => $key === $search);

    }

    /**
     * ### Determines whether a data structure contains a given value
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::inArray() To check if a value exists in an array.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::where() To check if a value exists
     * in data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Contains($collection)->value('John');
     *
     * // true
     * ```
     *
     * @param value-of<TDataStructure> $search <p>
     * The searched value.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return bool True if a data structure contains a provided value, false otherwise.
     */
    public function value (mixed $search):bool {

        if ($this->data_structure instanceof ArrStorage)
            return Arr::inArray($search, $this->data_structure->toArray());

        return $this->where(fn($value) => $value === $search);

    }

    /**
     * ### Determines whether a data structure contains a given key and value pair
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::where() To check if a value exists
     * in data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Contains($collection)->pair('firstname', 'John');
     *
     * // true
     * ```
     *
     * @param key-of<TDataStructure> $search_key <p>
     * The searched key.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     * @param value-of<TDataStructure> $with_value $search <p>
     * The searched key.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return bool True if a data structure contains a provided key and value pair, false otherwise.
     */
    public function pair (mixed $search_key, mixed $with_value):bool {

        return $this->where(fn($value, $key) => $key === $search_key && $value === $with_value);

    }

    /**
     * ### Determines whether a data structure contains a given key or value
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::where() To check if a value exists
     * in data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Contains($collection)->keyOrValue('Doe');
     *
     * // true
     * ```
     *
     * @param key-of<TDataStructure>|value-of<TDataStructure> $search <p>
     * The searched key or value.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return bool True if a data structure contains a provided key or value, false otherwise.
     */
    public function keyOrValue (mixed $search):bool {

        return $this->where(fn($value, $key) => $key === $search || $value === $search);

    }

    /**
     * ### Determines whether a data structure contains a given type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Data::getType() To get the current value type.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Contains::where() To check if a value exists
     * in data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Contains($collection)->type(Type::T_STRING);
     *
     * // true
     * ```
     *
     * @param \FireHub\Core\Support\Enums\Data\Type $type <p>
     * The searched type.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\TypeUnknownException If a type of value is unknown.
     *
     * @return bool True if a data structure contains a provided type, false otherwise.
     */
    public function type (Type $type):bool {

        return $this->where(fn($value) => $type === Data::getType($value));

    }

    /**
     * ### Determines whether a data structure contains a given item by user function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage::toArray() To get data storage
     * as an array.
     * @uses \FireHub\Core\Support\LowLevel\Arr::any() To check if at least one array element satisfies a callback
     * function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\Contains;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $check = new Contains($collection)->where(fn($value, $key) => $value === 'John');
     *
     * // true
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):bool $callback <p>
     * User-defined function.
     * </p>
     *
     * @return bool True if a data structure contains a provided item, false otherwise.
     */
    public function where (callable $callback):bool {

        if ($this->data_structure instanceof ArrStorage)
            return Arr::any($this->data_structure->toArray(), $callback); // @phpstan-ignore argument.type

        foreach ($this->data_structure as $storage_key => $storage_value)
            if ($callback($storage_value, $storage_key)) return true;

        return false;

    }

}
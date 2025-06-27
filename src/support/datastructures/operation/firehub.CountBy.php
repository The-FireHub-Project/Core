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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ {
    Associative, Obj
};
use FireHub\Core\Support\Enums\Data\Type;
use FireHub\Core\Support\LowLevel\ {
    Data, DataIs
};

use function FireHub\Core\Support\Helpers\Data\toString;

/**
 * ### Count operations for data structures
 * @since 1.0.0
 *
 * @template TDataStructure of \FireHub\Core\Support\Contracts\HighLevel\DataStructures
 */
readonly class CountBy {

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
     * ### Count elements by searched value
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy::where To count elements by a user-defined function.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::exist() To check if any values
     * where found.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::get() To get a number of found
     * values.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $count_by_values = new CountBy($collection)->value('Jane');
     *
     * // 3
     * ```
     *
     * @param value-of<TDataStructure> $search <p>
     * The searched key.
     * If the key is a string, the comparison is done in a case-sensitive manner.
     * </p>
     *
     * @return non-negative-int Number of elements in the data structure by searched value.
     */
    public function value (mixed $search):int {

        $result = $this->where(fn($value) => $value === $search);

        return $result->exist(1) ? ($result->get(1) ?? 0) : 0;

    }

    /**
     * ### Count elements by values
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative As return.
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy::where To count elements by a user-defined function.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To find whether the array key is a string.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::int() To find whether the array key is an integer.
     * @uses \FireHub\Core\Support\Helpers\Data\toString() To convert value to string.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $count_by_values = new CountBy($collection)->values();
     *
     * // ['Jane' => 3, 'John' => 1, 'Richard' => 2]
     * ```
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<array-key, positive-int>
     * Number of elements of a data structure by values.
     */
    public function values ():Associative {

        return $this->where(
            fn($value) => DataIs::string($value) || DataIs::int($value) // @phpstan-ignore argument.type
                ? $value
                : toString($value, detailed: true)
        );

    }

    /**
     * ### Count elements by searched type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy::where To count elements by a user-defined function.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::exist() To check if any values
     * where found.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative::get() To get a number of found
     * values.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $count_by_type = new CountBy($collection)->type(Type::T_STRING);
     *
     * // 2
     * ```
     *
     * @param \FireHub\Core\Support\Enums\Data\Type $search <p>
     * The searched typed.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\TypeUnknownException If a type of value is unknown.
     *
     * @return non-negative-int Number of elements in the data structure by searched type.
     */
    public function type (Type $search):int {

        $result = $this->where(fn($value) => Data::getType($value) === $search);

        return $result->exist(1) ? ($result->get(1) ?? 0) : 0;

    }

    /**
     * ### Count elements by value types
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj As return.
     * @uses \FireHub\Core\Support\LowLevel\Data::getType() To get a data type of the value.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::attach() To add the data type to
     * the result.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::has() To check if an object exists
     * in the collection.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::info() To get the information about
     * the object.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $count_by_type = new CountBy($collection)->types();
     *
     * // [Type::T_STRING => 2, Type::T_INT => 2]
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\TypeUnknownException If a type of value is unknown.
     * @throws \FireHub\Core\Support\DataStructures\Exceptions\KeyDoesntExistException If the key doesn't exist.
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj<\FireHub\Core\Support\Enums\Data\Type, positive-int>
     * Number of elements of a data structure by type.
     */
    public function types ():Obj {

        $storage = new Obj();

        foreach ($this->data_structure as $value) {

            $type = Data::getType($value);

            $storage->attach($type, ($storage->has($type) ? $storage->info($type) : 0) + 1); // @phpstan-ignore binaryOp.invalid

        }

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Count elements by user-defined function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $count_substrings = new CountBy($collection)->where(fn($value, $key) => substr((string)$value, 0, 1));
     *
     * // ['J' => 4, 'R' => 2]
     * ```
     *
     * @param callable(value-of<TDataStructure>, key-of<TDataStructure>):mixed $callback <p>
     * User-defined function.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<array-key, positive-int>
     * Number of elements of a data structure by user-defined function.
     */
    public function where (callable $callback):Associative {

        $storage = [];

        foreach ($this->data_structure as $key => $value) {

            $callable = $callback($value, $key);

            $storage[$callable] = ($storage[$callable] ?? 0) + 1;

        }

        return new Associative($storage);

    }

}
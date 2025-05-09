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
use FireHub\Core\Support\LowLevel\ {
    Data, DataIs
};

use function FireHub\Core\Support\Helpers\Data\toString;

/**
 * ### Count operations for data structures
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
readonly class CountBy {

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
     * ### Count elements in a data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::count() To count elements in a data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Collection\Operations\CountBy;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * new CountBy($collection)->elements();
     *
     * // 6
     * ```
     *
     * @return non-negative-int Number of elements of a data structure.
     */
    public function elements ():int {

        return $this->data_structure->count();

    }

    /**
     * ### Count elements by values
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative As return.
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
     * new CountBy($collection)->values();
     *
     * // ['Jane' => 3, 'John' => 1, 'Richard' => 2]
     * ```
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<array-key, positive-int>
     * Number of elements of a data structure by values.
     */
    public function values ():Associative {

        $storage = [];

        foreach ($this->data_structure as $value) {

            $value = DataIs::string($value) || DataIs::int($value) ? $value : toString($value);

            $storage[$value] = ($storage[$value] ?? 0) + 1;

        }

        return new Associative($storage);

    }

    /**
     * ### Count elements by value type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Data::getType() To get a data type of the value.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::attach() To add the data type to
     * the result.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::exist() To check if the data type
     * exists in the result.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj::get() To get the data type from
     * the result.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new CountBy($collection)->type();
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
    public function type ():Obj {

        $storage = new Obj();

        foreach ($this->data_structure as $value) {

            $type = Data::getType($value);

            $storage->attach($type, ($storage->exist($type) ? $storage->get($type) : 0) + 1); // @phpstan-ignore binaryOp.invalid

        }

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Count elements by user-defined function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * new CountBy($collection)->where(fn($value, $key) => substr((string)$value, 0, 1));
     *
     * // ['J' => 4, 'R' => 2]
     * ```
     *
     * @param callable(TValue, TKey):string $callback <p>
     * User-defined function.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<string, positive-int> Number
     * of elements of a data structure by user-defined function.
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
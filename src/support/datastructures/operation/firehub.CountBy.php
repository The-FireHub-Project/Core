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
    Arr, Obj
};
use FireHub\Core\Support\LowLevel\ {
    Data, Iterator
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
     * @uses \FireHub\Core\Support\LowLevel\Iterator::count() To count elements in a data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr;
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

        return Iterator::count($this->data_structure);

    }

    /**
     * ### Count elements by values
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr As return.
     * @uses \FireHub\Core\Support\Helpers\Data\toString() To convert value to string.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Arr(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * new CountBy($collection)->values();
     *
     * // ['Jane' => 3, 'John' => 1, 'Richard' => 2]
     * ```
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr<string, positive-int> Number of
     * elements of a data structure by values.
     */
    public function values ():Arr {

        $storage = new Arr();

        foreach ($this->data_structure as $value) {

            $value = toString($value);

            $storage[$value] = ($storage[$value] ?? 0) + 1; // @phpstan-ignore offsetAssign.valueType

        }

        return $storage;

    }

    /**
     * ### Count elements by value type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = new Arr(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new CountBy($collection)->type();
     *
     * // [Type::T_STRING => 2, Type::T_INT => 2]
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\TypeUnknownException If a type of value is unknown.
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj<\FireHub\Core\Support\Enums\Data\Type, positive-int>
     * Number of elements of a data structure by type.
     */
    public function type ():Obj {

        $storage = new Obj();

        foreach ($this->data_structure as $value) {

            $type = Data::getType($value);

            $storage[$type] = ($storage[$type] ?? 0) + 1; // @phpstan-ignore binaryOp.invalid

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
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Arr(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new CountBy($collection)->func(fn($value, $key) => substr((string)$value, 0, 1));
     *
     * // ['J' => 1, 'D' => 1, 2 => 2]
     * ```
     *
     * @param callable(TValue, TKey):string $callback <p>
     * User-defined function.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Arr<string, positive-int> Number of
     * elements of a data structure by user-defined function.
     */
    public function func (callable $callback):Arr {

        $storage = new Arr();

        foreach ($this->data_structure as $key => $value) {

            $callable = $callback($value, $key);

            $storage[$callable] = ($storage[$callable] ?? 0) + 1; // @phpstan-ignore offsetAssign.valueType

        }

        return $storage;

    }

}
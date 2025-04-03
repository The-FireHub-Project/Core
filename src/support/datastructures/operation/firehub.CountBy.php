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
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix;
use FireHub\Core\Support\Exceptions\Data\TypeUnknownException;
use FireHub\Core\Support\LowLevel\ {
    Data, Iterator
};

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

        return Iterator::count($this->data_structure);

    }

    /**
     * ### Count elements by values
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix As return.
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
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix<TValue, positive-int>
     * Number of elements of a data structure.
     */
    public function values ():Mix {

        $storage = new Mix();

        foreach ($this->data_structure as $value)
            $storage[$value] = ($storage[$value] ?? 0) + 1; // @phpstan-ignore binaryOp.invalid

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Count elements by value type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix As return.
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
     * @throws \FireHub\Core\Support\Exceptions\Data\TypeUnknownException If a type of value is unknown.
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix<\FireHub\Core\Support\Enums\Data\Type, positive-int>
     * Number of elements of a data structure.
     */
    public function type ():Mix {

        $storage = new Mix();

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
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * new CountBy($collection)->func(fn($value) => fn($value) => $value === 'Jane');
     *
     * // [0 => 3, 1 => 3]
     * ```
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix<TValue, positive-int>
     * Number of elements of a data structure.
     */
    public function func (callable $callback):Mix {

        $storage = new Mix();

        foreach ($this->data_structure as $value) {

            $callable = $callback($value);

            $storage[$callable] = ($storage[$callable] ?? 0) + 1; // @phpstan-ignore binaryOp.invalid

        }

        return $storage; // @phpstan-ignore return.type

    }

    /**
     * ### Count elements by user-defined function with additional index check
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     * use FireHub\Core\Support\DataStructures\Operations\CountBy;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * new CountBy($collection)->funcAssoc(fn($value, $key) => substr((string)$value, 0, 1));
     *
     * // ['J' => 1, 'D' => 1, 2 => 2]
     * ```
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix<TValue, positive-int>
     * Number of elements of a data structure.
     */
    public function funcAssoc (callable $callback):Mix {

        $storage = new Mix();

        foreach ($this->data_structure as $key => $value) {

            $callable = $callback($value, $key);

            $storage[$callable] = ($storage[$callable] ?? 0) + 1; // @phpstan-ignore binaryOp.invalid

        }

        return $storage; // @phpstan-ignore return.type

    }

}
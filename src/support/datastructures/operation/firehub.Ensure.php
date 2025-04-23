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
use FireHub\Core\Support\Enums\Data\ {
    Category, Type
};
use FireHub\Core\Support\LowLevel\ {
    DataIs, Obj
};

use function FireHub\Core\Support\Helpers\Data\isType;

/**
 * ### Methods to ensure data structure items is of a certain type
 * @since 1.0.0
 */
readonly class Ensure {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures As parameter.
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<mixed, mixed> $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected DataStructures $data_structure
    ) {}

    /**
     * ### Verify that all items of a data structure are of certain type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Data\Type As parameter.
     * @uses \FireHub\Core\Support\Enums\Data\Category As parameter.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::all() To verify that all items of data
     * structure passes a given truth test.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To check if the value is a string.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::object() To check if the value is an object.
     * @uses \FireHub\Core\Support\LowLevel\Obj::ofClass() To check if value is of class.
     * @uses \FireHub\Core\Support\Helpers\Data\isType() To check a data structure value type.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->ensure()->all(Type::T_STRING);
     *
     * // true
     * ```
     *
     * @param class-string|\FireHub\Core\Support\Enums\Data\Type|\FireHub\Core\Support\Enums\Data\Category $type <p>
     * Type to check on all data structure items.
     * </p>
     *
     * @return bool True if all values is of a type, false otherwise.
     */
    public function all (string|Type|Category $type):bool {

        return $this->data_structure->all(
            fn($value) => DataIs::string($type)
                ? DataIs::object($value) && Obj::ofClass($value, $type)
                : isType($value, $type)
        );

    }

    /**
     * ### Verify that any item of a data structure are of certain type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Data\Type As parameter.
     * @uses \FireHub\Core\Support\Enums\Data\Category As parameter.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::any() To verify that any item of data
     * structure passes a given truth test.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To check if the value is a string.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::object() To check if the value is an object.
     * @uses \FireHub\Core\Support\LowLevel\Obj::ofClass() To check if value is of class.
     * @uses \FireHub\Core\Support\Helpers\Data\isType() To check a data structure value type.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->ensure()->any(Type::T_STRING);
     *
     * // true
     * ```
     *
     * @param class-string|\FireHub\Core\Support\Enums\Data\Type|\FireHub\Core\Support\Enums\Data\Category $type <p>
     * Type to check on all data structure items.
     * </p>
     *
     * @return bool True if any of the values is of a type, false otherwise.
     */
    public function any (string|Type|Category $type):bool {

        return $this->data_structure->any(
            fn($value) => DataIs::string($type)
                ? DataIs::object($value) && Obj::ofClass($value, $type)
                : isType($value, $type)
        );

    }

    /**
     * ### Verify that none of the items in a data structure are of certain type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Data\Type As parameter.
     * @uses \FireHub\Core\Support\Enums\Data\Category As parameter.
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::none() To verify that none of the items in a
     * data structure passes a given truth test.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To check if the value is a string.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::object() To check if the value is an object.
     * @uses \FireHub\Core\Support\LowLevel\Obj::ofClass() To check if value is of class.
     * @uses \FireHub\Core\Support\Helpers\Data\isType() To check a data structure value type.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     * use FireHub\Core\Support\Enums\Data\Type;
     *
     * $collection = Indexed::fromArray(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->ensure()->none(Type::T_STRING);
     *
     * // true
     * ```
     *
     * @param class-string|\FireHub\Core\Support\Enums\Data\Type|\FireHub\Core\Support\Enums\Data\Category $type <p>
     * Type to check on all data structure items.
     * </p>
     *
     * @return bool True if none of the values is of a type, false otherwise.
     */
    public function none (string|Type|Category $type):bool {

        return $this->data_structure->none(
            fn($value) => DataIs::string($type)
                ? DataIs::object($value) && Obj::ofClass($value, $type)
                : isType($value, $type)
        );

    }

}
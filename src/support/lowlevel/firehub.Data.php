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

namespace FireHub\Core\Support\LowLevel;

use FireHub\Core\Support\Enums\Data\ {
    ResourceType, Type
};
use FireHub\Core\Support\Exceptions\Data\ {
    ArrayToStringConversionException, CannotSerializeException, FailedToSetTypeException, ObjectConversionException,
    SetAsResourceException, UnserializeFailedException, UnserializeFalseOrNullException, ValueTypeUnknownException
};
use Exception, Stringable;

use function get_resource_type;
use function gettype;
use function serialize;
use function settype;
use function unserialize;

/**
 * ### Data low-level proxy class
 *
 * Class contains variable handling methods for data manipulation.
 * @since 1.0.0
 */
final class Data {

    /**
     * ### Gets data type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_BOOL As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_INT As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_FLOAT As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_STRING As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_ARRAY As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_OBJECT As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_NULL As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_RESOURCE As data type.
     *
     * @param mixed $value <p>
     * The variable being type-checked.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\ValueTypeUnknownException If a type of value is unknown.
     *
     * @return \FireHub\Core\Support\Enums\Data\Type Type of data.
     */
    public static function getType (mixed $value):Type {

        return match ($internal_type = gettype($value)) {
            'boolean' => Type::T_BOOL,
            'integer' => Type::T_INT,
            'double' => Type::T_FLOAT,
            'string' => Type::T_STRING,
            'array' => Type::T_ARRAY,
            'object' => Type::T_OBJECT,
            'NULL' => Type::T_NULL,
            'resource', 'resource (closed)' => Type::T_RESOURCE,
            default => throw new ValueTypeUnknownException($internal_type)
        };

    }

    /**
     * ### Sets data type
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Data::getType() To get $value type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_BOOL As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_STRING As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_INT As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_FLOAT As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_ARRAY As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_OBJECT As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_NULL As data type.
     * @uses \FireHub\Core\Support\Enums\Data\Type::T_RESOURCE As data type.
     *
     * @param mixed $value <p>
     * The variable being converted to type.
     * </p>
     * @param \FireHub\Core\Support\Enums\Data\Type $type <p>
     * Type to convert variable to.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\ValueTypeUnknownException If a type of value is unknown.
     * @throws \FireHub\Core\Support\Exceptions\Data\ArrayToStringConversionException If trying to convert an array to
     * string.
     * @throws \FireHub\Core\Support\Exceptions\Data\FailedToSetTypeException If failed to set a type for value.
     * @throws \FireHub\Core\Support\Exceptions\Data\ObjectConversionException If trying to convert an object to string,
     * int or float.
     * @throws \FireHub\Core\Support\Exceptions\Data\SetAsResourceException If trying to set a resource as a type.
     *
     * @return mixed Converted value.
     * @phpstan-return (
     *  $type is Type::T_ARRAY
     *  ? array<array-key, mixed>
     *  : ($type is Type::T_STRING
     *      ? string
     *      : ($type is Type::T_INT
     *          ? int
     *          : ($type is Type::T_FLOAT
     *              ? float
     *              : ($type is Type::T_OBJECT
     *                  ? object
     *                  : ($type is Type::T_BOOL
     *                      ? bool
     *                      : ($type is Type::T_NULL
     *                          ? null
     *                          : ($type is Type::T_RESOURCE
     *                              ? false
     *                              : mixed)))))))
     * )
     */
    public static function setType (mixed $value, Type $type):mixed {

        switch (true) {

            case self::getType($value) === Type::T_ARRAY && $type === Type::T_STRING:

                throw new ArrayToStringConversionException;

            case self::getType($value) === Type::T_OBJECT && !$value instanceof Stringable
                && (
                    $type === Type::T_STRING
                    || $type === Type::T_INT
                    || $type === Type::T_FLOAT
                ):

                throw new ObjectConversionException;

            case $type === Type::T_RESOURCE:

                throw new SetAsResourceException;

            default:

                settype($value, match ($type) {
                    Type::T_BOOL => 'boolean',
                    Type::T_INT => 'integer',
                    Type::T_FLOAT => 'double',
                    Type::T_ARRAY => 'array',
                    Type::T_OBJECT => 'object',
                    Type::T_NULL => 'NULL',
                    default => 'string'

                }) ?: throw new FailedToSetTypeException;

                return $value;

        }

    }

    /**
     * ### Gets the resource type
     * @since 1.0.0
     *
     * @param resource $resource <p>
     * The evaluated resource handle.
     * </p>
     *
     * @return \FireHub\Core\Support\Enums\Data\ResourceType Resource type or null if is not a resource.
     */
    public static function getResourceType (mixed $resource):ResourceType {

        return ResourceType::from(get_resource_type($resource));

    }

    /**
     * ### Generates storable representation of data
     *
     * Generates a storable representation of a value.
     * This is useful for storing or passing PHP values around without losing their type and structure.
     * To make the serialized string into a PHP value again, use unserialize().
     * @since 1.0.0
     *
     * @param scalar|array<array-key, mixed>|object|null $value <p>
     * The value is to be serialized.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\CannotSerializeException If try to serialize an anonymous class,
     * function, or resource.
     *
     * @return string String containing a byte-stream representation of a value that can be stored anywhere.
     *
     * @warning When serialize() serializes objects, the leading backslash is not included in the class name of
     * namespaced classes for maximum compatibility.
     * @note This is a binary string that may include null bytes and needs to be stored and handled as such. For
     * example, serialize() output should generally be stored in a BLOB field in a database, rather than a CHAR or
     * TEXT field.
     */
    public static function serialize (string|int|float|bool|array|object|null $value):string {

        try {

            return serialize($value);

        } catch (Exception) {

            throw new CannotSerializeException()
                ->withMessage("Anonymous classes, functions, and resources can't be serialized.");

        }

    }

    /**
     * ### Creates a PHP value from a stored representation
     * @since 1.0.0
     *
     * @param non-empty-string $data <p>
     * The serialized string.
     * </p>
     * @param bool|array<class-string> $allowed_classes [optional] <p>
     * Either an array of class names which should be accepted, false to accept no classes,
     * or true to accept all classes.
     * </p>
     * @param int $max_depth [optional] <p>
     * The maximum depth of structures is permitted during unserialization and is intended to prevent stack overflows.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\UnserializeFalseOrNullException If $data is already false, or
     * $data is NULL.
     * @throws \FireHub\Core\Support\Exceptions\Data\UnserializeFailedException If couldn't unserialize data.
     *
     * @return mixed The converted value is returned.
     */
    public static function unserialize (string $data, bool|array $allowed_classes = false, int $max_depth = 4096):mixed {

        return match ($data) {
            'b:0;', 'N;' => throw new UnserializeFalseOrNullException,
            default => ($unserialized_data = unserialize(
                $data,
                ['allowed_classes' => $allowed_classes, 'max_depth' => $max_depth])
            ) ? $unserialized_data : throw new UnserializeFailedException
        };

    }

}
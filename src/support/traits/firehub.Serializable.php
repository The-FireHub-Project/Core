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

namespace FireHub\Core\Support\Traits;

use FireHub\Core\Support\Traits\Exceptions\UnserializeNotSameObjectException;
use FireHub\Core\Support\LowLevel\Data;

/**
 * ### Trait contains all common serialize and unserialize methods
 * @since 1.0.0
 */
trait Serializable {

    /**
     * ### Creates an object from a stored representation
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Data::unserialize() To create an object from a stored representation.
     *
     * @param non-empty-string $data <p>
     * The serialized string.
     * </p>
     * @param int $max_depth [optional] <p>
     * The maximum depth of structures is permitted during unserialization and is intended to prevent stack overflows.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\UnserializeFailedException If couldn't unserialize data, $data is
     * already false, or $data is NULL.
     * @throws \FireHub\Core\Support\Traits\Exceptions\UnserializeNotSameObjectException If data for unserialization is
     * not from the same object.
     *
     * @return static Object from a serialized parameter.
     */
    public static function unserialize (string $data, int $max_depth = 4096):static {

        return ($data = Data::unserialize($data, true, $max_depth)) instanceof static
            ? $data : throw new UnserializeNotSameObjectException;

    }

    /**
     * ### Generates storable representation of an object
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Data::serialize() To generate a storable representation of an object.
     *
     * @throws \FireHub\Core\Support\Exceptions\Data\CannotSerializeException If try to serialize an anonymous class,
     * function, or resource.
     *
     * @return string String containing a byte-stream representation of an object that can be stored anywhere.
     *
     * @note This is a binary string that may include null bytes and needs to be stored and handled as such.
     * For example, [[Data#serialize()]] output should generally be stored in a BLOB field in a database, rather than
     * a CHAR or TEXT field.
     */
    public function serialize ():string {

        return Data::serialize($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    abstract public function __serialize ():array;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    abstract public function __unserialize (array $data):void;

}
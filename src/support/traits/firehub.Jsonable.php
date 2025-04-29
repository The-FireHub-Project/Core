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

use FireHub\Core\Support\Enums\JSON\ {
    Flag, Flags\Decode, Flags\Encode
};
use FireHub\Core\Support\Traits\Exceptions\JsonDecodingNotArrayException;
use FireHub\Core\Support\LowLevel\ {
    DataIs, JSON
};

/**
 * ### Trait contains all common JSON methods
 * @since 1.0.0
 */
trait Jsonable {

    /**
     * ### Decodes a JSON string to an object
     * @since 1.0.0
     *
     * @uses static::jsonToObject() To convert JSON string to an object.
     * @uses \FireHub\Core\Support\LowLevel\JSON::decode() To decode a JSON string to an object.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::array() To check if decoded JSON string is an array.
     *
     * @param string $json <p>
     * The JSON string being decoded.
     * </p>
     * @param positive-int $depth <p>
     * Set the maximum depth.
     * </p>
     * @param \FireHub\Core\Support\Enums\JSON\Flag|\FireHub\Core\Support\Enums\JSON\Flags\Decode ...$flags <p>
     * JSON flags.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\JSON\DecodingException If JSON decoding throws an error.
     * @throws \FireHub\Core\Support\Traits\Exceptions\JsonDecodingNotArrayException If provided JSON data is not
     * an array.
     *
     * @return static Object from JSON encoded parameter.
     *
     * @note All string data for $json parameter must be UTF-8 encoded.
     * @note Method already includes Flag::JSON_THROW_ON_ERROR.
     */
    public static function fromJson (string $json, int $depth = 512, Flag|Decode ...$flags):static {

        return static::jsonToObject( // @phpstan-ignore return.type
            DataIs::array($data = JSON::decode($json, true, $depth, ...$flags)) // @phpstan-ignore  argument.type
            ? $data : throw new JsonDecodingNotArrayException
        );

    }

    /**
     * ### JSON representation of an object
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\JSON::encode() As JSON representation of an object.
     *
     * @param positive-int $depth <p>
     * Set the maximum depth.
     * </p>
     * @param \FireHub\Core\Support\Enums\JSON\Flag|\FireHub\Core\Support\Enums\JSON\Flags\Encode ...$flags <p>
     * JSON flags.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\JSON\EncodingException If JSON encoding throws an error.
     *
     * @return non-empty-string|false JSON encoded string on success or false on failure.
     *
     * @note All string data must be UTF-8 encoded.
     * @note Method already includes Flag::JSON_THROW_ON_ERROR.
     */
    public function toJson (int $depth = 512, Flag|Encode ...$flags):string|false {

        return JSON::encode($this, $depth, ...$flags);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    abstract public function jsonSerialize ():array;

    /**
     * ### Convert JSON string to an object
     * @since 1.0.0
     *
     * @param array<array-key, mixed> $data <p>
     * Decoded JSON string as an array.
     * </p>
     *
     * @return static Object from JSON encoded parameter.
     */
    abstract private static function jsonToObject (array $data):static;

}
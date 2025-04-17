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

use FireHub\Core\Support\Enums\JSON\ {
    Flag, Flags\Decode, Flags\Encode, Flags\Validate
};
use FireHub\Core\Support\Exceptions\JSON\ {
    DecodingException, EncodingException
};
use JsonException;

use function json_decode;
use function json_encode;
use function json_validate;

/**
 * ### Object low-level proxy class
 *
 * Class allows you to collect information about objects.
 * @since 1.0.0
 *
 * @internal
 */
final class JSON {

    /**
     * ### JSON representation of a value
     *
     * Returns a string containing the JSON representation of the supplied value.
     * If the parameter is an array or object, it will be serialized recursively.
     * If a value to be serialized is an object, then by default only publicly visible properties will be included.
     * Alternatively, a class may implement JsonSerializable to control how its values are serialized to JSON.
     * The encoding is affected by the supplied flags, and additionally, the encoding of float values depends on the
     * value of serialize_precision.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\JSON\Flag As parameter.
     * @uses \FireHub\Core\Support\Enums\JSON\Flags\Encode As parameter.
     *
     * @param mixed $value <p>
     * The value being encoded.
     * Can be any type except a resource.
     * </p>
     * @param positive-int $depth [optional] <p>
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
     * @note All string data for $value parameter must be UTF-8 encoded.
     * @note Method already includes Flag::JSON_THROW_ON_ERROR.
     */
    public static function encode (mixed $value, int $depth = 512, Flag|Encode ...$flags):string|false {

        $bitmap = 0;
        foreach ($flags as $flag)
            if ($flag !== Flag::THROW_ON_ERROR) $bitmap += $flag->value;

        try {

            return json_encode($value, $bitmap + JSON_THROW_ON_ERROR, $depth);

        } catch (JsonException $error) {

            throw new EncodingException()->withMessage($error->getMessage());

        }

    }

    /**
     * ### Decodes a JSON string
     *
     * Takes a JSON-encoded string and converts it into a PHP value.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\JSON\Flag As parameter.
     * @uses \FireHub\Core\Support\Enums\JSON\Flags\Decode As parameter.
     *
     * @param string $json <p>
     * The JSON string being decoded.
     * </p>
     * @param bool $as_array [optional] <p>
     * If true method will return decoded JSON string as an associative array, otherwise it will return an object.
     * </p>
     * @param positive-int $depth [optional] <p>
     * Set the maximum depth.
     * </p>
     * @param \FireHub\Core\Support\Enums\JSON\Flag|\FireHub\Core\Support\Enums\JSON\Flags\Decode ...$flags <p>
     * JSON flags.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\JSON\DecodingException If JSON decoding throws an error.
     *
     * @return mixed Value encoded in JSON as an appropriate PHP type, or null is returned if the JSON can't be decoded
     * or if the encoded data is deeper than the nesting limit.
     *
     * @note All string data for $json parameter must be UTF-8 encoded.
     * @note Method already includes Flag::JSON_THROW_ON_ERROR.
     */
    public static function decode (string $json, bool $as_array = false, int $depth = 512, Flag|Decode ...$flags):mixed {

        $bitmap = 0;
        foreach ($flags as $flag)
            if ($flag !== Flag::THROW_ON_ERROR) $bitmap += $flag->value;

        try {

            return json_decode($json, $as_array, $depth, $bitmap + JSON_THROW_ON_ERROR);

        } catch (JsonException $error) {

            throw new DecodingException()->withMessage($error->getMessage());

        }

    }

    /**
     * ### Checks if a string contains valid JSON
     *
     * [[JSON#validate]] uses less memory than [[JSON#decode]] if the decoded JSON payload is not used because
     * it doesn't need to build the array or object structure containing the payload.
     * @since 1.0.0
     *
     * @param string $json <p>
     * The string to validate.
     * </p>
     * @param positive-int $depth [optional] <p>
     * Set the maximum depth.
     * </p>
     * @param \FireHub\Core\Support\Enums\JSON\Flags\Validate ...$flags <p>
     * JSON flags.
     * </p>
     *
     * @return bool True if the given string is syntactically valid JSON, false otherwise.
     *
     * @caution Calling [[JSON#validate]] immediately before [[JSON#decode]] will unnecessarily parse the string twice,
     * as [[JSON#decode]] implicitly performs validation during decoding.
     * [[JSON#validate]] should therefore only be used if the decoded JSON payload is not immediately used and knowing
     * whether the string contains valid JSON is needed.
     */
    public static function validate (string $json, int $depth = 512, Validate ...$flags):bool {

        $bitmap = 0;
        foreach ($flags as $flag) $bitmap += $flag->value;

        return json_validate($json, $depth, $bitmap); // @phpstan-ignore argument.type

    }

}
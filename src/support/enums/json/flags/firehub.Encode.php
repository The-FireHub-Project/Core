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

namespace FireHub\Core\Support\Enums\JSON\Flags;

/**
 * ### Enums flags for encode functions
 * @since 1.0.0
 */
enum Encode:int {

    /**
     * ### All < and > are converted to \u003C and \u003E
     * @since 1.0.0
     */
    case HEX_TAG = 1;

    /**
     * ### All & are converted to \u0026
     * @since 1.0.0
     */
    case HEX_AMP = 2;

    /**
     * ### All ' are converted to \u0027
     * @since 1.0.0
     */
    case HEX_APOS = 3;

    /**
     * ### All " are converted to \u0022
     * @since 1.0.0
     */
    case HEX_QUOT = 8;

    /**
     * ### Outputs an object rather than an array when a non-associative array is used
     * @since 1.0.0
     */
    case FORCE_OBJECT = 16;

    /**
     * ### Encodes numeric strings as numbers
     * @since 1.0.0
     */
    case NUMERIC_CHECK = 32;

    /**
     * ### Don't escape /
     * @since 1.0.0
     */
    case UNESCAPED_SLASHES = 64;

    /**
     * ### Use whitespace in returned data to format it
     * @since 1.0.0
     */
    case PRETTY_PRINT = 128;

    /**
     * ### Encode multibyte Unicode characters literally (default is to escape as \uXXXX)
     * @since 1.0.0
     */
    case UNESCAPED_UNICODE = 256;

    /**
     * ### Substitute some un-encodable values instead of failing
     * @since 1.0.0
     */
    case PARTIAL_OUTPUT_ON_ERROR = 512;

    /**
     * ### Ensures that float values are always encoded as a float value
     * @since 1.0.0
     */
    case PRESERVE_ZERO_FRACTION = 1024;

    /**
     * ### The line terminators are kept unescaped when UNESCAPED_UNICODE is supplied
     * @since 1.0.0
     */
    case UNESCAPED_LINE_TERMINATORS = 2048;

}
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

namespace FireHub\Core\Support\Enums\JSON;

/**
 * ### Enums are for both encode and decode functions
 * @since 1.0.0
 */
enum Flag:int {

    /**
     * ### The value passed to json_encode() includes a non-backed enum which can't be serialized
     * @since 1.0.0
     */
    case ERROR_NON_BACKED_ENUM = 11;

    /**
     * ### Ignore invalid UTF-8 characters
     * @since 1.0.0
     */
    case INVALID_UTF8_IGNORE = 1048576;

    /**
     * ### Convert invalid UTF-8 characters to \0xfffd (Unicode Character 'REPLACEMENT CHARACTER')
     * @since 1.0.0
     */
    case INVALID_UTF8_SUBSTITUTE = 2097152;

    /**
     * ### Throws JsonException if an error occurs instead of setting the global error state
     * @since 1.0.0
     */
    case THROW_ON_ERROR = 4194304;

}
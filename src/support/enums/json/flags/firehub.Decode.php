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
 * ### Enums flags for decode functions
 * @since 1.0.0
 */
enum Decode:int {

    /**
     * ### Decodes JSON objects as a PHP array
     * @since 1.0.0
     */
    case OBJECT_AS_ARRAY = 1;

    /**
     * ### Decodes large integers as their original string value
     * @since 1.0.0
     */
    case BIGINT_AS_STRING = 2;

}
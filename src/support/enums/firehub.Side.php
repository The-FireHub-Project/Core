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

namespace FireHub\Core\Support\Enums;

/**
 * ### Side enum
 * @since 1.0.0
 */
enum Side {

    /**
     * ### Use left side
     * @since 1.0.0
     */
    case LEFT;

    /**
     * ### Use right side
     * @since 1.0.0
     */
    case RIGHT;

    /**
     * ### Use both sides
     * @since 1.0.0
     */
    case BOTH;

}
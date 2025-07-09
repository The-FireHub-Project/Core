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

namespace FireHub\Core\Support\Enums\FileSystem;

/**
 * ### File permission enum
 * @since 1.0.0
 */
enum Permission:int {

    /**
     * ### User has no permissions
     * @since 1.0.0
     */
    case NOTHING = 0;

    /**
     * ### User with execute permissions can run a file as a program
     * @since 1.0.0
     */
    case EXECUTE = 1;

    /**
     * ### Grants the ability to modify or remove the content of the file
     * @since 1.0.0
     */
    case WRITE = 2;

    /**
     * ### Combination of write and execute permissions
     * @since 1.0.0
     */
    case WRITE_EXECUTE = 3;

    /**
     * ### Grants the ability to read, in other words, view the contents of the file
     * @since 1.0.0
     */
    case READ = 4;

    /**
     * ### Combination of read and execute permissions
     * @since 1.0.0
     */
    case READ_EXECUTE = 5;

    /**
     * ### Combination of read and write permissions
     * @since 1.0.0
     */
    case READ_WRITE = 6;

    /**
     * ### User has all permissions: read, write, and execute
     * @since 1.0.0
     */
    case ALL = 7;

}
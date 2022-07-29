<?php declare(strict_types = 1);

/**
 * This file is part of FireHub Web Application Framework package.
 * @since 0.2.0.pre-alpha.M2
 *
 * @author Danijel Galić
 * @copyright 2022 FireHub Web Application Framework
 * @license OSL Open Source License version 3 - [https://opensource.org/licenses/OSL-3.0](https://opensource.org/licenses/OSL-3.0)
 *
 * @package FireHub\Support
 * @version 1.0
 */

namespace FireHub\Support\Enums;

/**
 * ### File permission enum
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
enum FilePermission:int {

    /**
     * ### User has no permissions
     * @since 0.2.0.pre-alpha.M2
     */
    case NOTHING = 0;

    /**
     * ### User with execute permissions can run a file as a program
     * @since 0.2.0.pre-alpha.M2
     */
    case EXECUTE = 1;

    /**
     * ### Grants the capability to modify, or remove the content of the file
     * @since 0.2.0.pre-alpha.M2
     */
    case WRITE = 2;

    /**
     * ### Combination of write and execute permissions
     * @since 0.2.0.pre-alpha.M2
     */
    case WRITE_EXECUTE = 3;

    /**
     * ### Grants the capability to read, i.e., view the contents of the file
     * @since 0.2.0.pre-alpha.M2
     */
    case READ = 4;

    /**
     * ### Combination of read and execute permissions
     * @since 0.2.0.pre-alpha.M2
     */
    case READ_EXECUTE = 5;

    /**
     * ### Combination of read and write permissions
     * @since 0.2.0.pre-alpha.M2
     */
    case READ_WRITE = 6;

    /**
     * ### User has all permissions: read, write and execute
     * @since 0.2.0.pre-alpha.M2
     */
    case ALL = 7;

}
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
 * ### Data type enum
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
enum DataType:string {

    /**
     * ### A bool expresses a truth value, it can be either true or false
     * @since 0.2.0.pre-alpha.M2
     */
    case BOOL = 'boolean';

    /**
     * ### An int is a number of the set ℤ = {..., -2, -1, 0, 1, 2, ...}
     * @since 0.2.0.pre-alpha.M2
     */
    case INT = 'integer';

    /**
     * ### A floating-point number is represented approximately with a fixed number of significant digits
     * @since 0.2.0.pre-alpha.M2
     */
    case FLOAT = 'double';

    /**
     * ### A string is series of characters, where a character is the same as a byte
     * @since 0.2.0.pre-alpha.M2
     */
    case STRING = 'string';

    /**
     * ### An ordered map where map is a type that associates values to keys
     * @since 0.2.0.pre-alpha.M2
     */
    case ARRAY = 'array';

    /**
     * ### An Object is an individual instance of the data structure defined by a class
     * @since 0.2.0.pre-alpha.M2
     */
    case OBJECT = 'object';

    /**
     * ### The special null value represents a variable with no value
     * @since 0.2.0.pre-alpha.M2
     */
    case NULL = 'NULL';
}
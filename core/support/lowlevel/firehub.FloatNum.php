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

namespace FireHub\Support\LowLevel;

use FireHub\Support\Enums\DataType;

/**
 * ### Float low level class
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
final class FloatNum {

    /**
     * ### Checks if value is float
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is float, false otherwise.
     */
    public static function isFloat (mixed $value):bool {

        return Data::getType($value) === DataType::FLOAT;

    }

    /**
     * ### Convert value to float
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to convert.
     * </p>
     *
     * @return float Float representation of value.
     */
    public static function toFloat (mixed $value):float {

        /**
         * PHPStan stan reports value might not be float type
         * @phpstan-ignore-next-line
         */
        return Data::setType($value, DataType::FLOAT);

    }

}
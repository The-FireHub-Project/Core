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
 * ### Integer low level class
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
final class IntNum {

    /**
     * ### Checks if value is integer
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is integer, false otherwise.
     */
    public static function isInt (mixed $value):bool {

        return Data::getType($value) === DataType::INT;

    }

    /**
     * ### Convert value to int
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to convert.
     * </p>
     *
     * @return int Int representation of value.
     */
    public static function toInt (mixed $value):int {

        /**
         * PHPStan stan reports value might not be int type
         * @phpstan-ignore-next-line
         */
        return Data::setType($value, DataType::INT);

    }

}
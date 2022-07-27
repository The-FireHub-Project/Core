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

use function gettype;
use function settype;

/**
 * ### Data Type low level class
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
final class Data {

    /**
     * ### Get value type
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check type.
     * </p>
     *
     * @return \FireHub\Support\Enums\DataType Value type.
     */
    public static function getType (mixed $value):DataType {

        return DataType::from(gettype($value));

    }

    /**
     * ### Convert value to type
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to convert.
     * </p>
     * @param \FireHub\Support\Enums\DataType $type <p>
     * Type to convert to.
     * </p>
     *
     * @return mixed Converted value.
     */
    public static function setType (mixed $value, DataType $type):mixed {

        settype($value, $type->value);

        return $value;

    }

}
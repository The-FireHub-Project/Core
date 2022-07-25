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
 * ### Side enum
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
enum Side:int {

    /**
     * ### Use left side
     * @since 0.2.0.pre-alpha.M2
     */
    case LEFT = 0;

    /**
     * ### Use right side
     * @since 0.2.0.pre-alpha.M2
     */
    case RIGHT = 1;

    /**
     * ### Use both sides
     * @since 0.2.0.pre-alpha.M2
     */
    case BOTH = 2;

}
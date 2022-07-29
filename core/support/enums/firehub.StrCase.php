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
 * ### String case enum
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
enum StrCase:int {

    /**
     * ### Performs a full upper-case folding
     * @since 0.2.0.pre-alpha.M2
     */
    case UPPER = 0;

    /**
     * ### Performs a full lower-case folding
     * @since 0.2.0.pre-alpha.M2
     */
    case LOWER = 1;

    /**
     * ### Performs a full title-case conversion based on the Cased and CaseIgnorable derived Unicode properties. In particular this improves handling of quotes and apostrophes
     * @since 0.2.0.pre-alpha.M2
     */
    case TITLE = 2;

    /**
     * ### Performs a full case fold conversion which removes case distinctions present in the string. This is used for caseless matching
     * @since 0.2.0.pre-alpha.M2
     */
    case MB_CASE_FOLD = 3;

}
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

namespace FireHub\Core\Support\Enums\Number;

use RoundingMode;

/**
 * ### Enum for rounding number options
 * @since 1.0.0
 */
enum Round {

    /**
     * ### Rounds number away from zero when it is halfway there, making 1.5 into 2 and -1.5 into -2
     * @since 1.0.0
     */
    case HALF_AWAY_FROM_ZERO;

    /**
     * ### Rounds number towards zero when it is halfway there, making 1.5 into 1 and -1.5 into -1
     * @since 1.0.0
     */
    case HALF_TOWARDS_ZERO;

    /**
     * ### Rounds towards the nearest even value when it is halfway there, making both 1.5 and 2.5 into 2
     * @since 1.0.0
     */
    case HALF_EVEN;

    /**
     * ### Rounds number towards the nearest odd value when it is halfway there, making 1.5 into 1 and 2.5 into 3
     * @since 1.0.0
     */
    case HALF_ODD;

    /**
     * ### Round to the nearest integer with a smaller or equal absolute value
     * @since 1.0.0
     */
    case TOWARDS_ZERO;

    /**
     * ### Round to the nearest integer with a greater or equal absolute value
     * @since 1.0.0
     */
    case AWAY_FROM_ZERO;

    /**
     * ### Round to the largest integer that is smaller or equal
     * @since 1.0.0
     */
    case NEGATIVE_INFINITY;

    /**
     * ### Round to the smallest integer that is greater or equal
     * @since 1.0.0
     */
    case POSITIVE_INFINITY;

    /**
     * ### Calculate rounding mode
     * @since 1.0.0
     *
     * @return RoundingMode Calculated round.
     */
    public function calculate ():RoundingMode {

        return match ($this) {
            self::HALF_AWAY_FROM_ZERO => RoundingMode::HalfAwayFromZero,
            self::HALF_TOWARDS_ZERO => RoundingMode::HalfTowardsZero,
            self::HALF_EVEN => RoundingMode::HalfEven,
            self::HALF_ODD => RoundingMode::HalfOdd,
            self::TOWARDS_ZERO => RoundingMode::TowardsZero,
            self::AWAY_FROM_ZERO => RoundingMode::AwayFromZero,
            self::NEGATIVE_INFINITY => RoundingMode::NegativeInfinity,
            default => RoundingMode::PositiveInfinity
        };

    }

}
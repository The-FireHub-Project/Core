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

namespace FireHub\Core\Support\LowLevel;

use FireHub\Core\Support\Exceptions\Number\ {
    ArithmeticException, DivideByZeroException
};
use ArithmeticError;

use function intdiv;

/**
 * ### Integer number low-level proxy class
 *
 * An int is a number of the set Z = {..., -2, -1, 0, 1, 2, ...}.
 * Int can be specified in decimal (base 10), hexadecimal (base 16), octal (base 8) or binary (base 2) notation.
 * The negation operator can be used to denote a negative int.
 * @since 1.0.0
 *
 * @internal
 */
final class NumInt extends Num {

    /**
     * ### Integer division
     * @since 1.0.0
     *
     * @param int $dividend <p>
     * Number to be divided.
     * </p>
     * @param non-zero-int $divisor <p>
     * Number which divides the $dividend.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Number\ArithmeticException If the $dividend is PHP_INT_MIN and
     * the $divisor is -1.
     * @throws \FireHub\Core\Support\Exceptions\Number\DivideByZeroException If $divisor is 0.
     *
     * @return int The integer quotient of the division of $dividend by $divisor.
     */
    public static function divide (int $dividend, int $divisor):int {

        if ($divisor === 0) throw new DivideByZeroException()->withNumber($dividend);

        try {

            return intdiv($dividend, $divisor);

        } catch (ArithmeticError $error) {

            throw new ArithmeticException()
                ->withNumber($dividend)
                ->withMessage($error->getMessage());

        }

    }

}
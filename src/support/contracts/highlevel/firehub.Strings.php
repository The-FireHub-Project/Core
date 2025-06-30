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

namespace FireHub\Core\Support\Contracts\HighLevel;

use FireHub\Core\Support\Contracts\Magic\Stringable;

/**
 * #### Strings contract
 *
 * A string is a stream of character.
 * @since 1.0.0
 *
 * @template TCharacters of string
 */
interface Strings extends Stringable {

    /**
     * ### Get string as raw string
     * @since 1.0.0
     *
     * @return TCharacters Character as string.
     */
    public function print ():string;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @return TCharacters The string representation of the object.
     */
    public function __toString ():string;

}
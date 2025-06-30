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

namespace FireHub\Core\Support\Contracts\HighLevel\Characters;

/**
 * ### Codepoint contract
 *
 * Codepoints is a site dedicated to Unicode and all things related to codepoints, characters, glyphs
 * and internationalization.
 * @since 1.0.0
 */
interface Codepoint {

    /**
     * ### Get codepoint position
     * @since 1.0.0
     *
     * @return non-negative-int Codepoint position.
     */
    public function position ():int;

    /**
     * ### Get character from codepoint
     * @since 1.0.0
     *
     * @return string Character from codepoint.
     */
    public function character ():string;

}
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
 * ### Characters contract
 *
 * Interface allows you to represent character.
 * @since 1.0.0
 */
interface Characters extends Stringable {

    /**
     * ### Get character as codepoint
     * @since 1.0.0
     *
     * @return int Character as codepoint.
     */
    public function codepoint ():int;

}
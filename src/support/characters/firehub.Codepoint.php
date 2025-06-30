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

namespace FireHub\Core\Support\Characters;

use FireHub\Core\Support\Contracts\HighLevel\Characters\Codepoint as CodepointCharacter;
use FireHub\Core\Support\LowLevel\CharMB;

/**
 * ### Character codepoint
 * @since 1.0.0
 */
class Codepoint implements CodepointCharacter {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param non-negative-int $codepoint <p>
     * Codepoint position.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected int $codepoint
    ) {}

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function position ():int {

        return $this->codepoint;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\CharMB::chr() To get character by Unicode code point value.
     *
     * @throws \FireHub\Core\Support\Exceptions\Codepoint\CodepointToCharacterException If codepoint couldn't be
     * converted to character.
     */
    public function character ():string {

        return CharMB::chr($this->codepoint);

    }

}
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

namespace FireHub\Core\Support\Exceptions\Codepoint;

use FireHub\Core\Support\Exceptions\CodepointException;

/**
 * ### Codepoint to character exception
 * @since 1.0.0
 */
class CodepointToCharacterException extends CodepointException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param int $codepoint <p>
     * The codepoint.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected int $codepoint
    ) {

        parent::__construct($codepoint);

        $this->message = "Codepoint: {$this->codepoint} couldn't be converted to character.";

    }

}
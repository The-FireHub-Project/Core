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

namespace FireHub\Core\Support\Exceptions\Char;

use FireHub\Core\Support\Exceptions\CharException;

/**
 * ### Character to codepoint conversion exception
 * @since 1.0.0
 */
class CharacterToCodepointException extends CharException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $character
     *
     * @return void
     */
    public function __construct (
        protected string $character
    ) {

        parent::__construct($character);

        $this->message = "Character: {$this->character} could not be converted to codepoint.";

    }

}
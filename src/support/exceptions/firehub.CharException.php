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

namespace FireHub\Core\Support\Exceptions;

use FireHub\Core\Support\Enums\String\Encoding;
use FireHub\Core\Components\Error\Exception;

/**
 * ### Character exception
 * @since 1.0.0
 */
class CharException extends Exception {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $character <p>
     * The character.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $character
    ) {

        $this->message = "Character: {$this->character} error.";

        parent::__construct();

    }

    /**
     * ### Sets the character encoding for this exception
     * @since 1.0.0
     *
     * @param null|\FireHub\Core\Support\Enums\String\Encoding $encoding [optional] <p>
     * The character encoding to be set.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withEncoding (?Encoding $encoding = null):static {

        return $this->appendMessageIfExists($encoding, 'Character encoding: '.($encoding ? $encoding::class : '').'.');

    }

}
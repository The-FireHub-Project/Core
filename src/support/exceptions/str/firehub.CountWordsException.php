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

namespace FireHub\Core\Support\Exceptions\Str;

use FireHub\Core\Support\Exceptions\StrException;

/**
 * ### Count words exception
 * @since 1.0.0
 */
class CountWordsException extends StrException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $string <p>
     * The string.
     * </p>
     * @param 0|1|2 $format<p>
     * The format.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $string,
        protected int $format
    ) {

        parent::__construct($string);

        $this->message = "Failed to count words for string: {$this->string}, with format {$this->format}.";

    }

    /**
     * ### Sets the characters for this exception
     * @since 1.0.0
     *
     * @param null|string $characters [optional] <p>
     * Stripped characters.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withCharacters (?string $characters = null):static {

        return $this->appendMessageIfExists($characters, 'Using characters: '.($characters ?? '').'.');

    }

}
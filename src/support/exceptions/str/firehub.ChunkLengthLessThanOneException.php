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
 * ### Chunk length less than one exception
 * @since 1.0.0
 */
class ChunkLengthLessThanOneException extends StrException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $string <p>
     * The string.
     * </p>
     * @param int $length <p>
     * Chunk length.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $string,
        protected int $length
    ) {

        parent::__construct($string);

        $this->message = "Length cannot be less (current length: {$this->length}) than one for string: {$this->string}.";

    }

}
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

namespace FireHub\Core\Support\Exceptions\Arr;

use FireHub\Core\Support\Exceptions\ArrException;

/**
 * ### Chunk length too small exception
 * @since 1.0.0
 */
class ChunkLengthTooSmallException extends ArrException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param int $length <p>
     * Chunk length.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected int $length
    ) {

        $this->message = "Length is less than 1, you provided: {$this->length}.";

        parent::__construct();

    }

}
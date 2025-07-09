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
 *
 * @method $this withLength (?int $length) ### Length
 */
class ChunkLengthLessThanOneException extends StrException {

    /**
     * ### Length
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $length = null {
        set {
            $this->length = $value;
            $this->appendMessage("Using length: {$this->length}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Length cannot be less than one for string.';

    }

}
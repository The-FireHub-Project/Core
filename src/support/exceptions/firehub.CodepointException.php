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
 * ### Codepoint exception
 * @since 1.0.0
 *
 * @method $this withCodepoint (?int $codepoint) ### Codepoint
 * @method $this withEncoding (?Encoding $encoding) ### Encoding
 */
class CodepointException extends Exception {

    /**
     * ### Codepoint
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $codepoint = null {
        set {
            $this->codepoint = $value;
            $this->appendMessage("Using codepoint: {$this->codepoint}.");
        }
    }

    /**
     * ### Encoding
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $encoding = null {
        set {
            $this->encoding = $value;
            $this->appendMessage("Using encoding: {$this->encoding}.");
        }
    }

}
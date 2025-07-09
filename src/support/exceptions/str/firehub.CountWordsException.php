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
 *
 * @method $this withCharacters (?string $characters) ### Characters
 * @method $this withFormat (?int $format) ### Format
 */
class CountWordsException extends StrException {

    /**
     * ### Characters
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $characters = null {
        set {
            $this->characters = $value;
            $this->appendMessage("Using characters: {$this->characters}.");
        }
    }

    /**
     * ### Format
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $format = null {
        set {
            $this->format = $value;
            $this->appendMessage("Using format: {$this->format}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Failed to count words for string.';

    }

}
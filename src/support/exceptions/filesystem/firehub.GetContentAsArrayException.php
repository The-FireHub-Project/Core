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

namespace FireHub\Core\Support\Exceptions\FileSystem;

use FireHub\Core\Support\Exceptions\FileSystemException;

/**
 * ### Get content as array exception
 * @since 1.0.0
 *
 * @method $this withSkipEmptyLines (?bool $skip_empty_lines) ### Skip empty lines
 * @method $this withIgnoreNewLines (?bool $ignore_new_lines) ### Ignore new lines
 */
class GetContentAsArrayException extends FileSystemException {

    /**
     * ### Skip empty lines
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $skip_empty_lines = null {
        set {
            $this->skip_empty_lines = $value;
            $this->appendMessage("Skip empty lines: {$this->skip_empty_lines}.");
        }
    }

    /**
     * ### Ignore new lines
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $ignore_new_lines = null {
        set {
            $this->ignore_new_lines = $value;
            $this->appendMessage("Ignore new lines: {$this->ignore_new_lines}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot get content from file as array.';

    }

}
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
 * ### Get content exception
 * @since 1.0.0
 *
 * @method $this withOffset (?int $offset) ### Offset
 * @method $this withLength (?int $length) ### Chunk length
 */
class GetContentException extends FileSystemException {

    /**
     * ### Offset
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $offset = null {
        set {
            $this->offset = $value;
            $this->appendMessage("With offset: {$this->offset}.");
        }
    }

    /**
     * ### Chunk length
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $length = null {
        set {
            $this->length = $value;
            $this->appendMessage("With length: {$this->length}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot get content from file.';

    }

}
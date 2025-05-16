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
 * ### Set last access and modification exception
 * @since 1.0.0
 *
 * @method $this withLastAccessed (?int $timestamp) ### Last accessed
 * @method $this withLastModified (?int $timestamp) ### Last modified
 */
class SetLastAccessAndModifyException extends FileSystemException {

    /**
     * ### Last accessed
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $last_accessed = null {
        set {
            $this->last_accessed = $value;
            $this->appendMessage("Last accessed on: {$this->last_accessed}.");
        }
    }

    /**
     * ### Last modified
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $last_modified = null {
        set {
            $this->last_modified = $value;
            $this->appendMessage("Last modified on: {$this->last_modified}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot set last access and modification time for path.';

    }

}
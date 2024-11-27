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
 */
class SetLastAccessAndModifyException extends FileSystemException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $path <p>
     * The path.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $path
    ) {

        parent::__construct($path);

        $this->message = "Cannot set last access and modification time for path: {$this->path}.";

    }

    /**
     * ### Sets the last accessed for this exception
     * @since 1.0.0
     *
     * @param null|int $last_accessed [optional] <p>
     * The last accessed.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withLastAccessed (?int $last_accessed = null):static {

        return $this->appendMessageIfExists($last_accessed, 'With last accessed: '.($last_accessed ?? '').'.');

    }

    /**
     * ### Sets the last modified for this exception
     * @since 1.0.0
     *
     * @param null|int $last_modified [optional] <p>
     * The last modified.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withLastModified (?int $last_modified = null):static {

        return $this->appendMessageIfExists($last_modified, 'With last modified: '.($last_modified ?? '').'.');

    }

}
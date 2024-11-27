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
 * ### Rename exception
 * @since 1.0.0
 */
class RenameException extends FileSystemException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $path <p>
     * The path.
     * </p>
     * @param string $new_path <p>
     * The new path.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $path,
        protected string $new_path
    ) {

        parent::__construct($path);

        $this->message = "Cannot rename path: {$this->path} to new path: {$this->new_path}.";

    }

}
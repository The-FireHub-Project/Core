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
 * ### Parent levels exception
 * @since 1.0.0
 */
class ParentLevelsException extends FileSystemException {

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

        $this->message = "Path: {$this->path} parent levels error.";

    }

}
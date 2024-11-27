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
 * ### Find path names exception
 * @since 1.0.0
 */
class FindPathNamesException extends FileSystemException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $pattern <p>
     * The pattern.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $pattern
    ) {

        parent::__construct($pattern);

        $this->message = "Error while searching for pattern: {$this->pattern}.";

    }

}
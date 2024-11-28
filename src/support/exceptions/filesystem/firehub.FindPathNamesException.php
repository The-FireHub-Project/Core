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
 *
 * @method $this withPattern (?string $pattern) ### Pattern
 * @method $this withOnlyFolders (?bool $only_folders) ### Only folders
 */
class FindPathNamesException extends FileSystemException {

    /**
     * ### Pattern
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $pattern = null {
        set {
            $this->pattern = $value;
            $this->appendMessage("With pattern: {$this->pattern}.");
        }
    }

    /**
     * ### Only folders
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $only_folders = null {
        set {
            $this->only_folders = $value;
            $this->appendMessage("Only folders is: {$this->only_folders}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Error while searching for pattern.';

    }

}
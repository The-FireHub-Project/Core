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

use FireHub\Core\Components\Error\Exception;

/**
 * ### File system exception
 * @since 1.0.0
 *
 * @method $this withPath (?string $path) ### Path
 */
class FileSystemException extends Exception {

    /**
     * ### Path
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $path = null {
        set {
            $this->path = $value;
            $this->appendMessage("With path: {$this->path}.");
        }
    }

}
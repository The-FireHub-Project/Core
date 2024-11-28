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

namespace FireHub\Core\Support\Exceptions\Autoload;

use FireHub\Core\Support\Exceptions\AutoloadException;

/**
 * ### Class not found exception
 * @since 1.0.0
 *
 * @method $this withClass (?string $class) ### Class name
 * @method $this withFileExtensions (?string $extension) ### File extensions
 */
class ClassNotFoundException extends AutoloadException {

    /**
     * ### Class name
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $class = null {
        set {
            $this->class = $value;
            $this->appendMessage("Tried to load class: {$this->class}.");
        }
    }

    /**
     * ### File extensions
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $file_extensions = null {
        set {
            $this->file_extensions = $value;
            $this->appendMessage("Tried with custom file extensions: {$this->file_extensions}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Class not found and there are no other autoloaders registered.';

    }

}
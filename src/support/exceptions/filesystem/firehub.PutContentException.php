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
 * ### Put content exception
 * @since 1.0.0
 *
 * @method $this withData (null|string[]|string $data) ### Data
 * @method $this withAppend (?bool $append) ### Append
 * @method $this withLock (?bool $lock) ### Lock
 * @method $this withCreateFile (?bool $create_file) ### Create a file
 */
class PutContentException extends FileSystemException {

    /**
     * ### Data
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $data = null {
        set {
            $this->data = $value;
            $this->appendMessage("With data: {$this->data}.");
        }
    }

    /**
     * ### Append
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $append = null {
        set {
            $this->append = $value;
            $this->appendMessage("Append is: {$this->append}.");
        }
    }

    /**
     * ### Lock
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $lock = null {
        set {
            $this->lock = $value;
            $this->appendMessage("Lock is: {$this->lock}.");
        }
    }

    /**
     * ### Create a file
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $create_file = null {
        set {
            $this->create_file = $value;
            $this->appendMessage("Create a file is: {$this->create_file}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot put content into file.';

    }

}
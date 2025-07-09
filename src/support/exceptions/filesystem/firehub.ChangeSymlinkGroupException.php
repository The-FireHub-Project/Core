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
 * ### Change symlink group exception
 * @since 1.0.0
 *
 * @method $this withGroup (null|string|int $group) ### Group
 */
class ChangeSymlinkGroupException extends FileSystemException {

    /**
     * ### Group
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $group = null {
        set {
            $this->group = $value;
            $this->appendMessage("With group: {$this->group}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot set group for symlink path.';

    }

}
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
 * ### Set owner exception
 * @since 1.0.0
 *
 * @method $this withUser (null|string|int $user) ### User
 */
class SetOwnerException extends FileSystemException {

    /**
     * ### User
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $user = null {
        set {
            $this->user = $value;
            $this->appendMessage("With user: {$this->user}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot set user for path.';

    }

}
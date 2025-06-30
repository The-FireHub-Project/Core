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
 * ### Copy path exception
 * @since 1.0.0
 *
 * @method $this withDestination (?string $to) ### Destination
 */
class CopyPathException extends FileSystemException {

    /**
     * ### Destination
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $destination = null {
        set {
            $this->destination = $value;
            $this->appendMessage("To destination: {$this->destination}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Could not copy path.';

    }

}
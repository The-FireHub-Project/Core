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

namespace FireHub\Core\Support\DataStructures\Exceptions;

/**
 * ### Key doesn't exist Exception
 * @since 1.0.0
 *
 * @method $this withKey (mixed $key) ### Key to access
 */
class KeyDoesntExistException extends DataStructureException {

    /**
     * ### Offset key
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $key = null {
        set {
            $this->key = $value;
            $this->appendMessage("With key: {$this->key}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = "Key doesn't exists.";

    }

}
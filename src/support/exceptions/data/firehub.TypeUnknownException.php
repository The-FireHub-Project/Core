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

namespace FireHub\Core\Support\Exceptions\Data;

use FireHub\Core\Support\Exceptions\DataException;

/**
 * ### Data type is unknown
 * @since 1.0.0
 *
 * @method $this withInternalType (?string $internal_type) ### Internal type
 */
class TypeUnknownException extends DataException {

    /**
     * ### Internal type
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $internal_type = null {
        set {
            $this->internal_type = $value;
            $this->appendMessage("Internal type is: {$this->internal_type}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Data type is unknown.';

    }

}
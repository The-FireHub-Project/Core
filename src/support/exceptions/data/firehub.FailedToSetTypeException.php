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

use FireHub\Core\Support\Enums\Data\Type;
use FireHub\Core\Support\Exceptions\DataException;

/**
 * ### Failed to set data type exception
 * @since 1.0.0
 *
 * @method $this withVal (mixed $value) ### Value
 * @method $this withType (?Type $type) ### Type
 */
class FailedToSetTypeException extends DataException {

    /**
     * ### Value
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $val = null {
        set {
            $this->val= $value;
            $this->appendMessage("Tried to from value: {$this->val}.");
        }
    }

    /**
     * ### Type
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $type = null {
        set {
            $this->type= $value;
            $this->appendMessage("Tried to set type: {$this->type}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Failed to set a type to for value.';

    }

}
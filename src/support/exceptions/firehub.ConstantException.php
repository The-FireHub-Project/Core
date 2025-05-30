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
 * ### Constant exception
 * @since 1.0.0
 *
 * @method $this withName (?string $name) ### Constant name
 */
class ConstantException extends Exception {

    /**
     * Constant name
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $name = null {
        set {
            $this->name = $value;
            $this->appendMessage("Constant name: {$this->name}.");
        }
    }

}
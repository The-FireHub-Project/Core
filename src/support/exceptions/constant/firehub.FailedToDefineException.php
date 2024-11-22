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

namespace FireHub\Core\Support\Exceptions\Constant;

use FireHub\Core\Support\Exceptions\ConstantException;

/**
 * ### Failed to define constant exception
 * @since 1.0.0
 */
class FailedToDefineException extends ConstantException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $constant <p>
     * Constant name.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $constant
    ) {

        $this->message = "Failed to define constant: {$this->constant}.";

        parent::__construct($constant);

    }

}
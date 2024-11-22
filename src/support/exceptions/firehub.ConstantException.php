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
 */
class ConstantException extends Exception {

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

        $this->message = "Constant: {$this->constant} error.";

        parent::__construct();

    }

}
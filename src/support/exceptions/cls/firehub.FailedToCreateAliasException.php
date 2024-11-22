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

namespace FireHub\Core\Support\Exceptions\Cls;

use FireHub\Core\Support\Exceptions\ClsException;

/**
 * ### Failed to create alias exception
 * @since 1.0.0
 */
class FailedToCreateAliasException extends ClsException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param class-string $class <p>
     * Class FQN.
     * </p>
     * @param class-string $alias <p>
     * The alias name for the class.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $class,
        protected string $alias
    ) {

        parent::__construct($class);

        $this->message = "Failed to create alias: {$this->alias} for class {$this->class}.";

    }

}
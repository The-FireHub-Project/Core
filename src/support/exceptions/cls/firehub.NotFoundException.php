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
 * ### Not found exception
 * @since 1.0.0
 */
class NotFoundException extends ClsException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param class-string $class <p>
     * Class FQN.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $class
    ) {

        parent::__construct($class);

        $this->message = "Class: {$this->class} not found.";

    }

}
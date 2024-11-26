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

namespace FireHub\Core\Support\Exceptions\Autoload;

use FireHub\Core\Support\Exceptions\AutoloadException;

/**
 * ### Class not found exception
 * @since 1.0.0
 */
class ClassNotFoundException extends AutoloadException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param class-string $class <p>
     * Fully qualified class name that is being called.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $class
    ) {

        parent::__construct();

        $this->message = "Class: {$this->class} not found and there are no other autoloaders registered.";

    }

}
<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Kernel
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Kernel\Exceptions;

use FireHub\Core\Components\Error\Exception;

/**
 * ### Class is not a bootstrap exception
 * @since 1.0.0
 *
 * @method $this withClass (mixed $class) ### Class
 */
class NotBootstrapException extends Exception {

    /**
     * ### Class
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $class = null {
        set {
            $this->class = $value;
            $this->appendMessage("Using class: {$this->class}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Class is not a bootstrap.';

    }

}
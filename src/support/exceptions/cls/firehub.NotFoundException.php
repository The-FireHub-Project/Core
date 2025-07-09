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
 *
 * @method $this withAutoload (?bool $autoload) ### Autoload
 */
class NotFoundException extends ClsException {

    /**
     * ### Autoload
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $autoload = null {
        set {
            $this->autoload = $value;
            $this->appendMessage("Autoload is: {$this->autoload}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Class not found.';

    }

}
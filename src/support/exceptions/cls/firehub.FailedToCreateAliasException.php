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
 *
 * @method $this withAlias (?string $alias) ### Alias
 */
class FailedToCreateAliasException extends ClsException {

    /**
     * ### Alias
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $alias = null {
        set {
            $this->alias = $value;
            $this->appendMessage("Using alias: {$this->alias}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Failed to create alias for class.';

    }

}
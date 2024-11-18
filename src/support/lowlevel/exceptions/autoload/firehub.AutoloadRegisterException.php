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

namespace FireHub\Core\Support\LowLevel\Exceptions\Autoload;

use FireHub\Core\Support\LowLevel\Exceptions\AutoloadException;

/**
 * ### Autoload Register Exception
 * @since 1.0.0
 */
class AutoloadRegisterException extends AutoloadException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {

        $this->message = 'Failed to register a callback function as an autoloader.';

        parent::__construct();

    }

}
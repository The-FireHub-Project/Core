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

namespace FireHub\Core\Kernel;

use FireHub\Core\Initializers\Kernel;

/**
 * ### HTTP Kernel
 *
 * Process HTTP requests that come in through various sources and give a client the appropriate response.
 * @since 1.0.0
 */
class Http extends Kernel {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function handle ():string {

        return 'HTTP Response!';

    }

}
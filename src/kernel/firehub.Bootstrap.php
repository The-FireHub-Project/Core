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

/**
 * ### Bootstrap
 * @since 1.0.0
 */
interface Bootstrap {

    /**
     * ### Load bootstrap
     * @since 1.0.0
     *
     * @return bool True if bootstrap was loaded successfully, false otherwise.
     */
    public function load ():bool;

}
<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Initializers
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Initializers;

/**
 * ### Bootloader
 * @since 1.0.0
 */
interface Bootloader {

    /**
     * ### Load bootloader
     * @since 1.0.0
     *
     * @return bool True if bootloader was loaded successfully, false otherwise.
     */
    public function load ():bool;

}
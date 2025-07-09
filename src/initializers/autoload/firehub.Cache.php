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

namespace FireHub\Core\Initializers\Autoload;

/**
 * The loader cache for finding classes
 * @since 1.0.0
 */
interface Cache {

    /**
     * ### Add a key-value pair to cache
     * @since 1.0.0
     *
     * @param string $key <p>
     * Cache key as a class name.
     * </p>
     * @param string $value <p>
     * Cache value as a class file system path.
     * </p>
     *
     * @return bool True if a key-value pair is added to cache, false otherwise.
     */
    public function add (string $key, string $value):bool;

    /**
     * ### Get cache value from provided key
     * @since 1.0.0
     *
     * @param string $key <p>
     * Cache key as a class name.
     * </p>
     *
     * @return string|false Cache value if the key exists, false otherwise.
     */
    public function get (string $key):string|false;

}
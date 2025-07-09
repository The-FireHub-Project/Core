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
 * The loader for finding class path
 * @since 1.0.0
 */
interface Loader {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload\Cache As parameter.
     *
     * @param null|\FireHub\Core\Initializers\Autoload\Cache $cache [optional] <p>
     * The loader cache for finding classes.
     * </p>
     *
     * @return void
     */
    public function __construct (?Cache $cache = null);

    /**
     * ### Invoke autoload function being registered
     * @since 1.0.0
     *
     * @param string $class <p>
     * Fully qualified class name that is being loaded.
     * </p>
     *
     * @return void
     */
    public function __invoke (string $class):void;

}
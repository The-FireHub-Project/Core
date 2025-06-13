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

use FireHub\Core\Initializers\Autoload\Loader;
use FireHub\Core\Support\Exceptions\Autoload\ {
    RegisterAutoloaderException, UnregisterAutoloaderException
};
use FireHub\Core\Support\LowLevel\SplAutoload;

/**
 * ### Automatically loads classes and interfaces
 *
 * Autoload registers any number of autoloaders, enabling for classes and interfaces to be automatically loaded
 * if they're currently not defined.
 * By registering autoloaders, FireHub is given a last chance to load the class or interface before it fails with
 * an error.
 * Any class-like construct may be autoloaded the same way.
 * That includes classes, interfaces, traits, and enumerations.
 * @since 1.0.0
 *
 * @api
 */
final readonly class Autoload {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param \FireHub\Core\Initializers\Autoload\Loader $loader <p>
     * Loader being used to find class paths.
     * </p>
     * @param bool $prepend <p>
     * Whether to prepend the autoloader on the stack instead of appending it.
     * </p>
     *
     * @return void
     */
    private function __construct (
        private Loader $loader,
        private bool $prepend
    ) {

        try {

            SplAutoload::register($this->loader, $this->prepend);

        } catch (RegisterAutoloaderException) {}

    }

    /**
     * ### Register a new autoloaded implementation at the end of the queue
     * @since 1.0.0
     *
     * @param \FireHub\Core\Initializers\Autoload\Loader $loader <p>
     * Loader being used to find class paths.
     * </p>
     *
     * @return self New autoload implementation.
     */
    public static function append (Loader $loader):self {

        return new self($loader, false);

    }

    /**
     * ### Register a new autoloaded implementation at the end of the queue
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload::prepend() To Register a new autoloaded implementation at
     * the end of the queue.
     *
     * @param \FireHub\Core\Initializers\Autoload\Loader $loader <p>
     * Loader being used to find class paths.
     * </p>
     *
     * @return self New autoload implementation.
     *
     * @note This method is alias for [[Autoload#append()]].
     */
    public static function register (Loader $loader):self {

        return self::prepend($loader);

    }

    /**
     * ### Register a new autoloaded implementation at the beginning of the queue
     * @since 1.0.0
     *
     * @param \FireHub\Core\Initializers\Autoload\Loader $loader <p>
     * Loader being used to find class paths.
     * </p>
     *
     * @return self New autoload implementation.
     */
    public static function prepend (Loader $loader):self {

        return new self($loader, true);

    }

    /**
     * ### Get all registered autoloader implementations
     * @since 1.0.0
     *
     * @return list<callable(string):void> List of autoloader implementations.
     */
    public static function implementations ():array {

        return SplAutoload::functions();

    }

    /**
     * ### Unregister autoload implementation
     *
     * Removes a function from the autoloaded queue. If the queue is activated and empty after removing the given
     * function, then it will be deactivated. When this function results in the queue being deactivated, any autoload
     * function that previously existed will not be reactivated.
     * @since 1.0.0
     *
     * @return bool True if autoloader was unregistered, false otherwise.
     */
    public function unregister ():bool {

        try {

            return SplAutoload::unregister($this->loader);

        } catch (UnregisterAutoloaderException) {

            return false;

        }

    }

}
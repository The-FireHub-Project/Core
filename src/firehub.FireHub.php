<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core;

use FireHub\Core\Initializers\ {
    Bootloader, FireHubConfigurator, Kernel
};
use FireHub\Core\Initializers\Exceptions\ {
    FailedToLoadBootloaderException, NotBootloaderException, NotKernelException
};
use FireHub\Core\Support\LowLevel\ {
    Cls, DataIs
};

/**
 * ### Main FireHub class for bootstrapping
 *
 * This class contains all system definitions, constants, and dependant components for FireHub bootstrapping.
 * @since 1.0.0
 */
final class FireHub {

    /**
     * ### Default bootloaders
     * @since 1.0.0
     *
     * @var array<int|class-string<\FireHub\Core\Initializers\Bootloader>,
     *     class-string<\FireHub\Core\Initializers\Bootloader>|array<array-key, mixed>>
     */
    private array $bootloaders = [] {
        get => [...$this->bootloaders, ...[
            \FireHub\Core\Initializers\Bootloaders\RegisterConstants::class,
            \FireHub\Core\Initializers\Bootloaders\RegisterHelpers::class,
            \FireHub\Core\Initializers\Bootloaders\RegisterAutoloaders::class => [
                'cache' => $this->configurator->autoload_cache
            ]]
        ];
    }

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\FireHubConfigurator To get FireHub configuration.
     * @uses \FireHub\Core\FireHub::loadBootloaders() To load bootloaders.
     *
     * @param \FireHub\Core\Initializers\FireHubConfigurator $configurator <p>
     * FireHub application configuration.
     * </p>
     *
     * @throws \FireHub\Core\Initializers\Exceptions\FailedToLoadBootloaderException If failed to load bootloader.
     * @throws \FireHub\Core\Initializers\Exceptions\NotBootloaderException If any of the provided classes is not
     * bootloader.
     *
     * @return void
     */
    public function __construct (
        private readonly FireHubConfigurator $configurator
    ) {

        $this->loadBootloaders();

    }

    /**
     * ### Light the torch
     *
     * This methode serves for instantiating the FireHub framework.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Cls::ofClass() To check if the provided kernel is a real kernel.
     *
     * @throws \FireHub\Core\Initializers\Exceptions\NotKernelException If class isn't kernel.
     *
     * @return string Response from Kernel.
     */
    public function boot ():string {

        return Cls::ofClass($this->configurator->kernel, Kernel::class)
            ? new $this->configurator->kernel()->handle()
            : throw new NotKernelException()->withClass($this->configurator->kernel);

    }

    /**
     * ### Load bootloaders
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Cls::ofClass() To check if all provided bootloaders are a real bootloader.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To check if $key or $value of bootloaders is a string.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::array() To check if $value of bootloaders is an array.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::object() To check if $value of bootloaders is an object.
     *
     * @throws \FireHub\Core\Initializers\Exceptions\FailedToLoadBootloaderException If failed to load bootloader.
     * @throws \FireHub\Core\Initializers\Exceptions\NotBootloaderException If any of the provided classes is not
     * bootloader.
     *
     * @return $this This object.
     */
    private function loadBootloaders ():self {

        foreach ([...$this->bootloaders, ...$this->configurator->bootloaders] as $key => $value)
            match (true) {
                DataIs::string($key) && DataIs::array($value) && Cls::ofClass($key, Bootloader::class)
                    => new $key(...$value)->load() ?: throw new FailedToLoadBootloaderException()->withClass($key),
                (DataIs::string($value) || DataIs::object($value)) && Cls::ofClass($value, Bootloader::class)
                    => new $value()->load() ?: throw new FailedToLoadBootloaderException()->withClass($value),
                default => throw new NotBootloaderException()->withClass($value)
            };

        return $this;

    }

}
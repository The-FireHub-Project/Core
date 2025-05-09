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

use FireHub\Core\Kernel\Bootstrap;
use FireHub\Core\Kernel\Exceptions\ {
    FailedToLoadBootstrapException, NotBootstrapException
};
use FireHub\Core\Support\LowLevel\ {
    Cls, DataIs
};

/**
 * ### Abstract Kernel
 * Process requests that come in through various sources and give a client the appropriate response.
 *
 * @since 1.0.0
 */
abstract class Kernel {

    /**
     * ### Default bootstraps
     * @since 1.0.0
     *
     * @var array<int|class-string<\FireHub\Core\Kernel\Bootstrap>,
     *     class-string<\FireHub\Core\Kernel\Bootstrap>|array<array-key, mixed>>
     */
    protected array $bootstraps = [];

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Kernel::loadBootstraps() To load bootstraps.
     *
     * @throws \FireHub\Core\Kernel\Exceptions\FailedToLoadBootstrapException If failed to load bootstrap.
     * @throws \FireHub\Core\Kernel\Exceptions\NotBootstrapException If any of the provided classes is not bootstrap.
     *
     * @return void
     */
    final public function __construct () {

        $this->loadBootstraps();

    }

    /**
     * ### Initialize bootstraps
     *
     * Load the series of bootstraps required to instantiating kernel.
     * Bootstraps will be loaded before after the kernel is loaded.
     * @since 1.0.0
     *
     * @param array<int|class-string<\FireHub\Core\Kernel\Bootstrap>, class-string<\FireHub\Core\Kernel\Bootstrap>|array<array-key, mixed>> $bootstraps <p>
     * List of bootstraps needed to load.
     * </p>
     *
     * @return $this This object.
     */
    public function withBootstraps (array $bootstraps):self {

        $this->bootstraps = [...$this->bootstraps, ...$bootstraps];

        return $this;

    }

    /**
     * ### Handle client request
     * @since 1.0.0
     *
     * @return string Information that needs to be sent back to the client from a given request.
     */
    abstract public function handle ():string;

    /**
     * ### Load bootstraps
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Cls::ofClass() To check if all provided bootstraps are a real bootstrap.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::string() To check if $key or $value of bootstraps is a string.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::array() To check if $value of bootstraps is an array.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::object() To check if $value of bootstraps is an object.
     *
     * @throws \FireHub\Core\Kernel\Exceptions\FailedToLoadBootstrapException If failed to load bootstrap.
     * @throws \FireHub\Core\Kernel\Exceptions\NotBootstrapException If any of the provided classes is not bootstrap.
     *
     * @return $this This object.
     */
    private function loadBootstraps ():self {

        foreach ($this->bootstraps as $key => $value)
            match (true) {
                DataIs::string($key) && DataIs::array($value) && Cls::ofClass($key, Bootstrap::class)
                    => new $key(...$value)->load() ?: throw new FailedToLoadBootstrapException()->withClass($key),
                (DataIs::string($value) || DataIs::object($value)) && Cls::ofClass($value, Bootstrap::class)
                    => new $value()->load() ?: throw new FailedToLoadBootstrapException()->withClass($value),
                default => throw new NotBootstrapException()->withClass($value)
            };

        return $this;

    }

}
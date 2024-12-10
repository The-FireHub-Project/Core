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

namespace FireHub\Core\Initializers\Autoload\Cache;

use FireHub\Core\Initializers\Autoload\Cache;
use FireHub\Core\Initializers\Exceptions\CacheExtensionNotLoadedException;
use FireHub\Core\Support\LowLevel\DataIs;
use FireHub\Core\Support\LowLevel\PHP;

use function apcu_fetch;
use function apcu_store;

/**
 * The cache for finding classes from APCu
 * @since 1.0.0
 */
final class Apcu implements Cache {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\PHP::isExtensionLoaded() To check if APCu extension is loaded.
     *
     * @throws \FireHub\Core\Initializers\Exceptions\CacheExtensionNotLoadedException If APCu extension is not loaded.
     *
     * @return void
     */
    public function __construct () {

        PHP::isExtensionLoaded('apcu')
            ?: throw new CacheExtensionNotLoadedException()
                ->withMessage('PHP extension "apcu" must be loaded in order to use APCu cache for autoloader.');

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function add (string $key, string $value):bool {

        return apcu_store($key, $value);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function get (string $key):string|false {

        $value = apcu_fetch($key);

        return DataIs::string($value) ? $value : false;

    }

}
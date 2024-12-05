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

namespace FireHub\Core\Initializers\Autoload\Loaders;

use FireHub\Core\Initializers\Autoload\ {
    Cache, Loader
};

use const DIRECTORY_SEPARATOR;

use function array_pop;
use function array_key_last;
use function array_shift;
use function explode;
use function implode;
use function is_file;
use function strtolower;

/**
 * Preloader for finding a class path for main classes – before the main autoloader is hit
 * @since 1.0.0
 */
final class Preloader implements Loader {

    /**
     * ### Home folder
     * @since 1.0.0
     *
     * @var string
     */
    private const string HOME_FOLDER = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param null|\FireHub\Core\Initializers\Autoload\Cache $cache [optional] <p>
     * The loader cache for finding classes.
     * </p>
     * @param string $class_prefix [optional] <p>
     * Filename prefix.
     * </p>
     */
    public function __construct (
        private readonly ?Cache $cache = null,
        private readonly string $class_prefix = ''
    ) {}

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::fromCache() To load class from cache if cache exists.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::toCache() To save class name and path
     * to cache if a cache exists.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::requireFile() To include a file.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Preloader::HOME_FOLDER As home folder.
     */
    public function __invoke (string $class):void {

        if ($this->fromCache($class)) return;

        $class_components = explode('\\', $class);
        array_shift($class_components);
        array_shift($class_components);

        $classname = $class_components[array_key_last($class_components)];
        array_pop($class_components);

        foreach ($class_components as $key => $value) $class_components[$key] = strtolower($value);
        $namespace = implode(DIRECTORY_SEPARATOR, $class_components);

        $file = self::HOME_FOLDER.$namespace.DIRECTORY_SEPARATOR.$this->class_prefix.$classname.'.php';

        if ($this->requireFile($file)) {

            $this->toCache($class, $file);

        }

    }

    /**
     * ### Include a file
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to a required file.
     * </p>
     *
     * @return bool True if a file is included, false otherwise.
     */
    private function requireFile (string $path):bool {

        if (is_file($path)) {

            require $path;

            return true;

        }

        return false;

    }

    /**
     * ### Load class from cache if cache exists
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload\Cache::get()
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::requireFile() To include a file.
     *
     * @param string $class <p>
     * Fully qualified class name that is being loaded.
     * </p>
     *
     * @return bool True if a file is loaded from the cache, false otherwise.
     */
    private function fromCache (string $class):bool {

        if (isset($this->cache) && $mapped_class = $this->cache->get($class)) {

            $this->requireFile($mapped_class);

            return true;

        }

        return false;

    }

    /**
     * ### Save class name and path to cache if cache exists
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload\Cache::add()
     *
     * @param string $class <p>
     * Fully qualified class name that is being loaded.
     * </p>
     * @param string $path <p>
     * Real path in a file system.
     * </p>
     *
     * @return void
     */
    private function toCache (string $class, string $path):void {

        if (isset($this->cache)) $this->cache->add($class, $path);

    }

}
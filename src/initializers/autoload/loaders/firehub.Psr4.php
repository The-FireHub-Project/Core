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
use FireHub\Core\Support\LowLevel\ {
    Arr, StrSB, File
};

use const FireHub\Core\Support\Constants\Path\DS;

/**
 * PSR-4 loader for finding class path
 * @since 1.0.0
 */
final class Psr4 implements Loader {

    /**
     * ### List of namespaces prefixes with its folders
     *
     * An associative array where the key is a namespace prefix, and the value is an array of base folders for classes
     * in that namespace.
     * @since 1.0.0
     *
     * @var array<non-empty-string, non-empty-string[]>
     */
    private array $namespaces = [];

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
     * ### Adds a base folder for a namespace prefix
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\StrSB::trim() To trim whitespaces on $namespace_prefix and $folder parameters.
     * @uses \FireHub\Core\Support\LowLevel\Arr::keyExist() To check if $namespace_prefix exists in namespaces.
     * @uses \FireHub\Core\Support\LowLevel\Arr::inArray() To check if $folder exists in $namespace_prefix.
     *
     * @param non-empty-string $namespace_prefix <p>
     * Namespaces prefix.
     * </p>
     * @param non-empty-string $folder <p>
     * Base folder.
     * </p>
     *
     * @return void
     */
    public function addNamespace (string $namespace_prefix, string $folder):void {

        $namespace_prefix = StrSB::trim($namespace_prefix);
        $namespace_prefix = StrSB::trim($namespace_prefix, characters: '\\');
        $folder = StrSB::trim($folder);

        if (empty($namespace_prefix) || empty($folder)) return;

        Arr::keyExist($namespace_prefix, $this->namespaces)
            ? (Arr::inArray($folder, $this->namespaces[$namespace_prefix])
            ?: $this->namespaces[$namespace_prefix][] = $folder)
            : $this->namespaces[$namespace_prefix][] = $folder;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::fromCache() To load class from cache if cache exists.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::toCache() To save class name and path
     * to cache if a cache exists.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::requireFile() To include a file.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::getPath() To get a class path.
     * @uses \FireHub\Core\Support\LowLevel\StrSB::firstPosition() To check if a namespace key is correct.
     */
    public function __invoke (string $class):void {

        if ($this->fromCache($class)) return;

        foreach ($this->namespaces as $namespace_prefix => $folders)
            if (StrSB::firstPosition($namespace_prefix, $class) === 0) {

                $path = $this->getPath($class, $namespace_prefix);

                foreach ($folders as $folder)
                    if ($this->requireFile($folder.$path)) {

                        $this->toCache($class, $folder.$path);

                        break;

                    }

            }

    }

    /**
     * ### Get class path
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\StrSB::part() To get part of the $class..
     * @uses \FireHub\Core\Support\LowLevel\StrSB::length() To check the length of a namespace key.
     * @uses \FireHub\Core\Support\LowLevel\StrSB::toLower() To lowercase namespace.
     * @uses \FireHub\Core\Support\LowLevel\StrSB::lastPart() To get $class parts for namespace and classname.
     * @uses \FireHub\Core\Support\LowLevel\StrSB::trim() To remove slashes from the classname.
     * @uses \FireHub\Core\Support\LowLevel\StrSB::replace() To replace slashes with directory separator constant.
     * @uses \FireHub\Core\Support\Constants\Path\DS As directory separator constant.
     *
     * @param string $class <p>
     * Fully qualified class name that is being loaded.
     * </p>
     * @param non-empty-string $namespace_prefix <p>
     * Namespace prefix as base folder.
     * </p>
     *
     * @return non-empty-string Class path.
     */
    private function getPath (string $class, string $namespace_prefix):string {

        $class = StrSB::part($class, StrSB::length($namespace_prefix));

        $namespace = StrSB::toLower(StrSB::lastPart('\\', $class, true) ?: '').'\\';

        $classname = StrSB::trim(StrSB::lastPart('\\', $class) ?: '', characters: '\\');

        return StrSB::replace('\\', DS, $namespace.$this->class_prefix.$classname).'.php';

    }

    /**
     * ### Include a file
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\File::isFile() To check if a path is a valid file.
     *
     * @param non-empty-string $path <p>
     * Path to a required file.
     * </p>
     *
     * @return bool True if a file is included, false otherwise.
     */
    private function requireFile (string $path):bool {

        if (File::isFile($path)) {

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
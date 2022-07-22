<?php declare(strict_types = 1);

/**
 * This file is part of FireHub Web Application Framework package.
 *
 * This file contains definitions and series of functions needed for calling objects.
 * File should return true if class is correctly loaded or false if error occurs.
 * @since 0.1.4.pre-alpha.M1
 *
 * @author Danijel Galić
 * @copyright 2022 FireHub Web Application Framework
 * @license OSL Open Source License version 3 - [https://opensource.org/licenses/OSL-3.0](https://opensource.org/licenses/OSL-3.0)
 *
 * @package FireHub\Initializers
 *
 * @version 1.0
 * @version 1.1 Added low-level classes
 */

namespace FireHub\Initializers;

use FireHub\Initializers\Enums\ {
    Prefix, Suffix
};
use FireHub\Support\LowLevel\Arr;
use Error;

use const FireHub\Initializers\Constants\DS;
use const FireHub\Initializers\Constants\FIREHUB_ROOT;

use function spl_autoload_register;
use function spl_autoload_unregister;
use function spl_autoload_functions;
use function spl_autoload_call;
use function class_exists;
use function sprintf;
use function explode;
use function is_file;
use function is_string;
use function strtolower;
use function implode;

require FIREHUB_ROOT.DS.'initializers/enums/firehub.Prefix.php';
require FIREHUB_ROOT.DS.'initializers/enums/firehub.Suffix.php';
require FIREHUB_ROOT.DS.'support/lowlevel/firehub.Arr.php';

/**
 * ### Autoload for called classes
 * @since 0.1.4.pre-alpha.M1
 *
 * @package FireHub\Initializers
 */
final class Autoload {

    /**
     * ### Register new autoload implementation
     * @since 0.1.4.pre-alpha.M1
     *
     * @param string $path <p>
     * Root path where register will try to find classes.
     * </p>
     * @param bool $prefix [optional] <p>
     * If true, first namespace component from class will be used as prefix for file name.
     *
     * note: Prefix must be listed in \FireHub\Initializers\Enums\Prefix to work.
     * </p>
     * @param bool $suffix [optional] <p>
     * If true, you can use underscore after class name to add type to class.
     *
     * note: Suffix must be listed in \FireHub\Initializers\Enums\Suffix to work.
     * </p>
     * @param bool $phar [optional] <p>
     * If true, your first available namespace component will get .phar suffix.
     * </p>
     * @param bool $prepend [optional] <p>
     * If true, register will prepend the autoloader on the autoload stack instead of appending it.
     * </p>
     *
     * @throws Error If class name is empty.
     * @throws Error If there is a problem suffix.
     *
     * @return bool True if autoload is registered, false otherwise.
     */
    public function register (string $path, bool $prefix = false, bool $suffix = false, bool $phar = false, bool $prepend = false):bool {

        return spl_autoload_register(fn(string $class_fqn) => $this->callback($path, $class_fqn, $prefix, $suffix, $phar), true, $prepend);

    }

    /**
     * ### Unregister all autoload implementations
     * @since 0.1.4.pre-alpha.M1
     *
     * @return void
     */
    public function unregister ():void {

        foreach ($this->functions() as $function) {

            spl_autoload_unregister($function);

        }

    }

    /**
     * ### Get all autoload implementations
     * @since 0.1.4.pre-alpha.M1
     *
     * @return array<int, callable> List of all autoload implementations.
     */
    public function functions ():array {

        return spl_autoload_functions();

    }

    /**
     * ### Try to load class from registered auto-loaders
     * @since 0.1.4.pre-alpha.M1
     *
     * @param class-string $class <p>
     * Class FQN to load.
     * </p>
     * @param array<int, mixed> $arguments [optional] <p>
     * List of constructor parameters to pass to class.
     * </p>
     *
     * @throws Error If class does not exist.
     *
     * @return void
     */
    public function load (string $class, array $arguments = []):void {

        spl_autoload_call($class);

        if (!class_exists($class, false)) {

            throw new Error(sprintf('Class %s does not exist', $class));

        }

        new $class(...$arguments);

    }

    /**
     * ### The autoload function being registered
     * @since 0.1.4.pre-alpha.M1
     *
     * @param string $path <p>
     * Root path where register will try to find classes.
     * </p>
     * @param string $class_fqn p>
     * Fully qualified class name to search for.
     * </p>
     * @param bool $prefix <p>
     * If true, first namespace component from class will be used as prefix for file name.
     *
     * note: Suffix must be listed in \FireHub\Initializers\Enums\Suffix to work.
     * </p>
     * @param bool $suffix <p>
     * If true, you can use underscore after class name to add type to class.
     *
     * note: Suffix must be listed in \FireHub\Initializers\Enums\Suffix to work.
     * </p>
     * @param bool $phar <p>
     * If true, your first available namespace component will get .phar suffix.
     * </p>
     *
     * @throws Error If class name is empty.
     * @throws Error If there is a problem suffix.
     *
     * @return void
     */
    private function callback (string $path, string $class_fqn, bool $prefix, bool $suffix, bool $phar):void {

        // list of class name components
        $class_name_components = explode('\\', $class_fqn);

        // extract class name from class components
        $class = $this->class($class_name_components) ?: throw new Error(sprintf('Class name %s is empty.', $class_fqn));

        // if using prefix option then extract prefix from class components
        $prefix = $prefix // if prefix option is true
            ? ($prefix = $this->prefix($class_name_components)) // if prefix exist
                ? $prefix->value.'.' // get value from prefix with dot at the end
                : ''
            : '';

        // if using suffix option then extract suffix from class name
        $suffix = $suffix // if suffix option is true
            ? ($suffix = $this->suffix($class)) // if suffix exist
                ? '.'.$suffix->value // get value from suffix with dot at the beginning
                : ''
            : '';

        // add phar extension to first class component
        !$phar ?: $this->phar($class_name_components);

        !is_file($file = $path.DS.$this->namespace($class_name_components).DS.$prefix.$class.$suffix.'.php') ?: require_once $file;

    }

    /**
     * ### Extract class name from class components
     *
     * @since 0.1.4.pre-alpha.M1
     * @since 0.2.0.pre-alpha.M1 Added low-level classes
     *
     * @param array<int, string> &$class_name_components <p>
     * List of class name components.
     * </p>
     *
     * @return string|false Class name or false if class components are empty.
     */
    private function class (array &$class_name_components):string|false {

        $class = Arr::last($class_name_components);

        Arr::pop($class_name_components);

        return !is_null($class) ? $class : false;

    }

    /**
     * ### Extract prefix from first component in class components
     *
     * Prefix must be listed in \FireHub\Initializers\Enums\Prefix to work.
     *
     * @since 0.1.4.pre-alpha.M1
     * @since 0.2.0.pre-alpha.M1 Added low-level classes
     *
     * @param array<int, string> &$class_name_components <p>
     * List of class name components.
     * </p>
     *
     * @return \FireHub\Initializers\Enums\Prefix|false Prefix for file.
     */
    private function prefix (array &$class_name_components):Prefix|false {

        $prefix = Arr::first($class_name_components);

        Arr::shift($class_name_components);

        return $prefix
            ? Prefix::tryFrom(strtolower($prefix))
                ?? false
            : false;

    }

    /**
     * ### Extract suffix from class name
     *
     * Suffix must be listed in \FireHub\Initializers\Enums\Suffix to work.
     *
     * @since 0.1.4.pre-alpha.M1
     * @since 0.2.0.pre-alpha.M1 Added low-level classes
     *
     * @param string &$class <p>
     * Class name.
     * </p>
     *
     * @throws Error If there is a problem suffix.
     *
     * @return \FireHub\Initializers\Enums\Suffix|false Suffix for file or false if none exist.
     */
    private function suffix (string &$class):Suffix|false {

        $components = explode('_', $class);

        $suffix = Arr::count($components) > 1 ? strtolower($components[1]) : false;

        $class = $components[0];

        return $suffix
            ? Suffix::tryFrom(strtolower($suffix))
                ?? throw new Error(sprintf('Class %s could not be loaded. There is a problem with suffix: %s', $class, $suffix))
            : false;

    }

    /**
     * ### Add phar extension to first class component
     *
     * @since 0.1.4.pre-alpha.M1
     * @since 0.2.0.pre-alpha.M1 Added low-level classes
     *
     * @param array<int, string> &$class_name_components <p>
     * List of class name components.
     * </p>
     *
     * @return void
     */
    private function phar (array &$class_name_components):void {

        if (!isset($class_name_components[0])) return;

        $phar = $class_name_components[0];

        Arr::shift($class_name_components);

        Arr::unshift($class_name_components, $phar . '.phar');

    }

    /**
     * ### Get namespace path from components
     * @since 0.1.4.pre-alpha.M1
     *
     * @param array<int, string> $class_name_components <p>
     * List of class name components.
     * </p>
     *
     * @return string Namespace path.
     */
    private function namespace (array $class_name_components):string {

        return strtolower(implode(DS, $class_name_components));

    }

}
<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core/Initializers
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Initializers;

use FireHub\Core\FireHub;
use FireHub\Core\Kernel\Http;
use FireHub\Core\Initializers\Autoload\Loaders\Preloader;

/**
 * ### FireHub application configuration
 * @since 1.0.0
 */
final class FireHubConfigurator {

    /**
     * ### Home folder
     * @since 1.0.0
     *
     * @var string
     */
    private const string HOME_FOLDER = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;

    /**
     * ### Files needed to be preloaded before autoload is hit
     * @since 1.0.0
     *
     * @var string[]
     */
    private array $preloaders = [
        __DIR__.DIRECTORY_SEPARATOR.'firehub.Autoload.php',
        __DIR__.DIRECTORY_SEPARATOR.'autoload'.DIRECTORY_SEPARATOR.'firehub.Loader.php',
        __DIR__.DIRECTORY_SEPARATOR.'autoload'.DIRECTORY_SEPARATOR.'loaders'.DIRECTORY_SEPARATOR.'firehub.Preloader.php',
        self::HOME_FOLDER.'support'.DIRECTORY_SEPARATOR.'lowlevel'.DIRECTORY_SEPARATOR.'firehub.SplAutoload.php',
        self::HOME_FOLDER.'support'.DIRECTORY_SEPARATOR.'lowlevel'.DIRECTORY_SEPARATOR.'firehub.FileSystem.php',
        self::HOME_FOLDER.'support'.DIRECTORY_SEPARATOR.'lowlevel'.DIRECTORY_SEPARATOR.'firehub.File.php'
    ];

    /**
     * ### Bootloaders
     * @since 1.0.0
     *
     * @var array<int|class-string<\FireHub\Core\Initializers\Bootloader>,
     *     class-string<\FireHub\Core\Initializers\Bootloader>|array<array-key, mixed>>
     */
    private(set) array $bootloaders = [];

    /**
     * ### Default Kernel
     * @since 1.0.0
     *
     * @var class-string<\FireHub\Core\Initializers\Kernel>
     */
    private(set) string $kernel = Http::class;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload::prepend() To register a new autoloaded implementation
     * at the beginning of the queue.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Preloader As preloader for finding a class path for main
     * classes – before the main autoloader is hit.
     *
     * @param string $app_path <p>
     * Base path of your application.
     * </p>
     *
     * @return void
     */
    public function __construct (
        private(set) readonly string $app_path
    ) {

        foreach ($this->preloaders as $preloader) require $preloader;

        Autoload::prepend(new Preloader(class_prefix: 'firehub.'));

    }

    /**
     * ### Initialize bootloaders
     *
     * Load the series of bootloaders required to boot FireHub framework.
     * Bootloaders will be loaded before the kernel is loaded.
     * @since 1.0.0
     *
     * @param array<int|class-string<\FireHub\Core\Initializers\Bootloader>, class-string<\FireHub\Core\Initializers\Bootloader>|array<array-key, mixed>> $bootloaders <p>
     * List of bootloaders needed to load.
     * </p>
     *
     * @return $this This object.
     */
    public function withBootloaders (array $bootloaders):self {

        $this->bootloaders = $bootloaders;

        return $this;

    }

    /**
     * ### Set kernel
     * @since 1.0.0
     *
     * @param class-string<\FireHub\Core\Initializers\Kernel> $kernel <p>
     * Kernel for application.
     * </p>
     *
     * @return $this This object.
     */
    public function withKernel (string $kernel):self {

        $this->kernel = $kernel;

        return $this;

    }

    /**
     * ### Create FireHub application
     * @since 1.0.0
     *
     * @uses \FireHub\Core\FireHub As return.
     *
     * @throws \FireHub\Core\Initializers\Exceptions\FailedToLoadBootloaderException If failed to load bootloader.
     * @throws \FireHub\Core\Initializers\Exceptions\NotBootloaderException If any of the provided classes is not
     * bootloader.
     *
     * @return \FireHub\Core\FireHub New Firehub Framework application.
     */
    public function create ():FireHub {

        return new FireHub($this);

    }

}
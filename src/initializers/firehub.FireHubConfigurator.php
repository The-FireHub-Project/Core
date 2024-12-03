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
    const string HOME_FOLDER = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;

    /**
     * ### Files needed to be preloaded before autoload is hit
     * @since 1.0.0
     *
     * @var string[]
     */
    private array $preloaders = [
        self::HOME_FOLDER.'firehub.FireHub.php',
        self::HOME_FOLDER.'components'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.'firehub.Exception.php',
        self::HOME_FOLDER.'support'.DIRECTORY_SEPARATOR.'lowlevel'.DIRECTORY_SEPARATOR.'firehub.DataIs.php',
        self::HOME_FOLDER.'support'.DIRECTORY_SEPARATOR.'lowlevel'.DIRECTORY_SEPARATOR.'firehub.ClsObj.php',
        self::HOME_FOLDER.'support'.DIRECTORY_SEPARATOR.'lowlevel'.DIRECTORY_SEPARATOR.'firehub.Cls.php',
        self::HOME_FOLDER.'initializers'.DIRECTORY_SEPARATOR.'firehub.Bootloader.php',
        self::HOME_FOLDER.'initializers'.DIRECTORY_SEPARATOR.'exceptions'.DIRECTORY_SEPARATOR.'firehub.FailedToLoadBootloaderException.php',
        self::HOME_FOLDER.'initializers'.DIRECTORY_SEPARATOR.'exceptions'.DIRECTORY_SEPARATOR.'firehub.NotBootloaderException.php',
        self::HOME_FOLDER.'initializers'.DIRECTORY_SEPARATOR.'bootloaders'.DIRECTORY_SEPARATOR.'firehub.RegisterConstants.php',
        self::HOME_FOLDER.'initializers'.DIRECTORY_SEPARATOR.'bootloaders'.DIRECTORY_SEPARATOR.'firehub.RegisterHelpers.php'
    ];

    /**
     * ### Bootloaders
     * @since 1.0.0
     *
     * @var class-string<\FireHub\Core\Initializers\Bootloader>[]
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
     * @return void
     */
    public function __construct () {

        foreach ($this->preloaders as $preloader) require $preloader;

    }

    /**
     * ### Initialize bootloaders
     *
     * Load the series of bootloaders required to boot FireHub framework.
     * Bootloaders will be loaded before the kernel is loaded.
     * @since 1.0.0
     *
     * @param class-string<\FireHub\Core\Initializers\Bootloader>[] $bootloaders <p>
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
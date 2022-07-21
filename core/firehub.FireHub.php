<?php declare(strict_types = 1);

/**
 * This file is part of FireHub Web Application Framework package.
 * @since 0.1.4.pre-alpha.M1
 *
 * @author Danijel Galić
 * @copyright 2022 FireHub Web Application Framework
 * @license OSL Open Source License version 3 - [https://opensource.org/licenses/OSL-3.0](https://opensource.org/licenses/OSL-3.0)
 *
 * @package FireHub
 * @version 1.0
 */

namespace FireHub;

use FireHub\Initializers\Autoload;
use DirectoryIterator, Error;

use const FireHub\Initializers\Constants\DS;
use const FireHub\Initializers\Constants\FIREHUB_ROOT;
use const FireHub\Initializers\Constants\APP_ROOT;
use const FireHub\Initializers\Constants\PACKAGES_ROOT;

/**
 * ### Main FireHub class for bootstrapping
 *
 * This class contains all system definitions, constants and dependant
 * components for FireHub bootstrapping.
 * @since 0.1.4.pre-alpha.M1
 *
 * @package FireHub
 */
final class FireHub {

    /**
     * ### Light the torch
     *
     * This methode serves for instantiating FireHub framework
     * and is the only publicly available method.
     * @since 0.1.4.pre-alpha.M1
     *
     * @throws Error if system cannot load Autoload file.
     * @throws Error If class name is empty.
     * @throws Error If there is a problem suffix.
     *
     * @return $this This object.
     */
    public function boot ():self {

        return $this
            ->bootloaders();

    }

    /**
     * ### Initialize bootloaders
     *
     * Load series of bootloaders required for
     * booting FireHub framework.
     * @since 0.1.4.pre-alpha.M1
     *
     * @throws Error if system cannot load Autoload file.
     * @throws Error If class name is empty.
     * @throws Error If there is a problem suffix.
     *
     * @return $this This object.
     */
    private function bootloaders ():self {

        return $this
            ->registerConstants()
            ->autoload();

    }

    /**
     * ### Register init constants
     *
     * This method will scan FireHub\Initializers\Constants folder
     * and automatically include all PHP files.
     * @since 0.1.4.pre-alpha.M1
     *
     * @return $this This object.
     */
    private function registerConstants ():self {

        foreach (new DirectoryIterator(__DIR__.'/initializers/constants/') as $file) {

            if ($file->isFile() && $file->getExtension() === 'php') {

                require $file->getPathname();

            }

        }

        return $this;

    }

    /**
     * ### Load autoload file
     *
     * This file contains definitions and series of functions
     * needed for calling objects.
     * @since 0.1.4.pre-alpha.M1
     *
     * @throws Error if system cannot load Autoload file.
     * @throws Error If class name is empty.
     * @throws Error If there is a problem suffix.
     *
     * @return $this This object.
     */
    private function autoload ():self {

        if (!include(FIREHUB_ROOT.DS.'initializers'.DS.'firehub.Autoload.php')) {

            throw new Error('Cannot load Autoload file, please contact your administrator.');

        }

        $autoload = new Autoload();

        // main firehub classes
        $autoload->register(FIREHUB_ROOT, true, true);

        // application classes
        $autoload->register(APP_ROOT, true, true);

        // package classes
        $autoload->register(PACKAGES_ROOT, true, true, true);

        return $this;

    }

}
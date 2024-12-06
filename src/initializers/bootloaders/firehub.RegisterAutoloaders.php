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

namespace FireHub\Core\Initializers\Bootloaders;

use FireHub\Core\Initializers\ {
    Autoload, Bootloader
};
use FireHub\Core\Initializers\Autoload\Loaders\Psr4;
use const FireHub\Core\Support\Constants\Path\DS;

/**
 * ### Register autoloaders
 * @since 1.0.0
 */
final class RegisterAutoloaders implements Bootloader {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Initializers\Autoload::prepend() To register a new autoloaded implementation
     * at the beginning of the queue.
     * @uses \FireHub\Core\Initializers\Autoload\Loaders\Psr4::addNamespace() To add a base folder for a namespace
     * prefix.
     */
    public function load ():bool {

        $loader = new Psr4(class_prefix: 'firehub.');
        $loader->addNamespace('FireHub\Core', __DIR__.DS.'..'.DS.'..');

        Autoload::prepend($loader);

        return true;

    }

}
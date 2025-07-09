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

use FireHub\Core\Initializers\Bootloader;
use DirectoryIterator, UnexpectedValueException;

use const DIRECTORY_SEPARATOR;

use function implode;

/**
 * ### Autoload all necessary constants
 * @since 1.0.0
 *
 * @internal
 */
final class RegisterConstants implements Bootloader {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function load ():bool {

        try {

            foreach (new DirectoryIterator(
                __DIR__.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, ['..', '..', 'support', 'constants']))
                 as $file
            ) if ($file->isFile() && $file->getExtension() === 'php') include $file->getPathname();

        } catch (UnexpectedValueException) {

            return false;

        }

        return true;

    }

}
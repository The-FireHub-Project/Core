<?php declare(strict_types = 1);

/**
 * This file is part of FireHub Web Application Framework package.
 * @since 0.2.0.pre-alpha.M2
 *
 * @author Danijel Galić
 * @copyright 2022 FireHub Web Application Framework
 * @license OSL Open Source License version 3 - [https://opensource.org/licenses/OSL-3.0](https://opensource.org/licenses/OSL-3.0)
 *
 * @package FireHub\Support
 * @version 1.0
 */

namespace FireHub\Support\LowLevel;

use FireHub\Support\Enums\Order;
use Error;

use const SCANDIR_SORT_ASCENDING;
use const SCANDIR_SORT_DESCENDING;
use const SCANDIR_SORT_NONE;

use function dirname;
use function scandir;

/**
 * ### Folder low level class
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
final class Folder {

    /**
     * ### Checks if path is a folder
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to check.
     * </p>
     *
     * @return bool True if path is folder, false otherwise.
     */
    public static function isFolder (string $path):bool {

        return DataIs::folder($path);

    }

    /**
     * ### Checks if folder is empty
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to check.
     * </p>
     *
     * @throws Error If path is not folder.
     * @throws Error When listing filenames in folder, maybe path $path is folder.
     *
     * @return bool True if folder is empty, false otherwise.
     */
    public static function isEmpty (string $path):bool {

        return self::isFolder($path) ? Arr::count(self::list($path)) === 2 : throw new Error("Path $path is not folder.");

    }

    /**
     * ### Returns parent folder name component of path
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not folder nor file.
     *
     * @return string The parent folder name of the given path.
     */
    public static function parentFolder (string $path):string {

        return self::isFolder($path) || File::isFile($path) ? dirname($path) : throw new Error("Path $path is not folder nor file.");

    }

    /**
     * ### List files and directories inside the specified path
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     * @param null|\FireHub\Support\Enums\Order $order [optional] <p>
     * Result order.
     * </p>
     *
     * @throws Error When listing filenames in folder, maybe path $path is folder.
     *
     * @return array<int, string> The parent folder name of the given path.
     */
    public static function list (string $path, ?Order $order = null):array {

        $order = match ($order) {
            Order::ASC => SCANDIR_SORT_ASCENDING,
            Order::DESC => SCANDIR_SORT_DESCENDING,
            default => SCANDIR_SORT_NONE
        };

        return ($filenames = scandir($path, $order)) ? $filenames : throw new Error("Error listing filenames in folder, maybe path $path is folder.");

    }

}
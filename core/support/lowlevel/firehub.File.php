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

use FireHub\Support\Enums\DataType;
use FireHub\Support\Enums\FilePermission;
use Error;

use const PATHINFO_FILENAME;
use const PATHINFO_EXTENSION;

use function dirname;
use function basename;
use function pathinfo;
use function decoct;
use function fileperms;
use function chmod;
use function octdec;

/**
 * ### File low level class
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
final class File {

    /**
     * ### Checks if path is a file
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to check.
     * </p>
     *
     * @return bool True if path is file, false otherwise.
     */
    public static function isFile (string $path):bool {

        return DataIs::file($path);

    }

    /**
     * ### Returns directory name component of path
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not file.
     *
     * @return string The basename of the given path.
     */
    public static function dirname (string $path):string {

        return self::isFile($path) ? dirname($path) : throw new Error("Path $path is not file.");

    }

    /**
     * ### Returns base name component of path
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not file.
     *
     * @return string The basename of the given path.
     */
    public static function basename (string $path):string {

        return self::isFile($path) ? basename($path) : throw new Error("Path $path is not file.");

    }

    /**
     * ### Get file name component of path
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not file.
     *
     * @return string The file name of the given path.
     */
    public static function filename (string $path):string {

        return self::isFile($path) ? pathinfo($path, PATHINFO_FILENAME) : throw new Error("Path $path is not file.");

    }

    /**
     * ### Get extension name component of path
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not file.
     *
     * @return string The extension of the given path.
     */
    public static function extension (string $path):string {

        return self::isFile($path) ? pathinfo($path, PATHINFO_EXTENSION) : throw new Error("Path $path is not file.");

    }

    /**
     * ### Gets file permissions
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If we cannot read permissions for file.
     * @throws Error If path is not file.
     *
     * @return string File permissions.
     */
    public static function getPermissions (string $path):string {

        $permissions = Data::getType($permissions = fileperms($path)) === DataType::INT ? $permissions : throw new Error("We cannot read permissions for file $path.");

        return self::isFile($path) ? Str::part(decoct($permissions), -4) : throw new Error("Path $path is not file.");

    }

    /**
     * ### Sets file permissions
     *
     * note: This method will not work on Windows.
     *
     * note: This method will not work on remote files as the file to be examined must be accessible via the server's filesystem.
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $owner_permissions <p>
     * File owner permission.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $owner_group_permissions <p>
     * File owner group permission.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $global_permissions <p>
     * Everyone's permission.
     * </p>
     *
     * @throws Error If we cannot convert octane to decimal number.
     * @throws Error If path is not file.
     *
     * @return bool True if permission was set, false otherwise.
     */
    public static function setPermissions (string $path, FilePermission $owner_permissions, FilePermission $owner_group_permissions, FilePermission $global_permissions):bool {

        $mode = '0'.$owner_permissions->value.$owner_group_permissions->value.$global_permissions->value;

        $permissions = Data::getType($permissions = octdec($mode)) === DataType::INT ? $permissions : throw new Error("We cannot convert octane to decimal number for number $mode.");

        return self::isFile($path) ? chmod($path, $permissions) : throw new Error("Path $path is not file.");

    }

}
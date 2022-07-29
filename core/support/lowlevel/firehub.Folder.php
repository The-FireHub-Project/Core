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
use FireHub\Support\Enums\Order;
use Error;

use const FireHub\Initializers\Constants\DS;
use const SCANDIR_SORT_ASCENDING;
use const SCANDIR_SORT_DESCENDING;
use const SCANDIR_SORT_NONE;

use function decoct;
use function fileperms;
use function chmod;
use function octdec;
use function mkdir;
use function rmdir;
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
     * ### Gets folder permissions
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If we cannot read permissions for folder.
     * @throws Error If path is not folder.
     *
     * @return string Folder permissions.
     */
    public static function getPermissions (string $path):string {

        $permissions = Data::getType($permissions = @fileperms($path)) === DataType::INT ? $permissions : throw new Error("We cannot read permissions for folder $path.");

        return self::isFolder($path) ? Str::part(decoct($permissions), -4) : throw new Error("Path $path is not folder.");

    }

    /**
     * ### Sets folder permissions
     *
     * note: This method will not work on Windows.
     *
     * note: This method will not work on remote folders as the folder to be examined must be accessible via the server's filesystem.
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $owner_permissions <p>
     * Folder owner permission.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $owner_group_permissions <p>
     * Folder owner group permission.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $global_permissions <p>
     * Everyone's permission.
     * </p>
     *
     * @throws Error If we cannot convert octane to decimal number.
     * @throws Error If path is not Folder.
     *
     * @return bool True if permission was set, false otherwise.
     */
    public static function setPermissions (string $path, FilePermission $owner_permissions, FilePermission $owner_group_permissions, FilePermission $global_permissions):bool {

        $mode = '0'.$owner_permissions->value.$owner_group_permissions->value.$global_permissions->value;

        $permissions = Data::getType($permissions = octdec($mode)) === DataType::INT ? $permissions : throw new Error("We cannot convert octane to decimal number for number $mode.");

        return self::isFolder($path) ? chmod($path, $permissions) : throw new Error("Path $path is note folder.");

    }

    /**
     * ### Copies source folder to destination
     *
     * note: If destination folder doesn't exist, it will be created.
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $source <p>
     * The source path.
     * </p>
     * @param string $destination <p>
     * The destination path.
     * </p>
     * @param bool $hidden [optional] <p>
     * Copy hidden file as well.
     * </p>
     *
     * @throws Error If it cannot create folder.
     * @throws Error If we cannot convert octane to decimal number.
     * @throws Error If destination path already exist.
     * @throws Error When listing filenames in folder, maybe path $path is folder.
     * @throws Error If overwrite is off and path already exist while coping file.
     *
     * @return bool True if folder was copied, false otherwise.
     */
    public static function copy (string $source, string $destination, bool $hidden = false):bool {

        if (!self::create($destination)) throw new Error("Cannot create folder $destination");

        foreach (self::list($source, hidden: $hidden) as $filename) {

            self::isFolder($source.DS.$filename)
                ? self::copy($source.DS.$filename, $destination.DS.$filename)
                : File::copy($source.DS.$filename, $destination, false);

        }

        return true;

    }

    /**
     * ### Moved folder
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $source <p>
     * The source path.
     * </p>
     * @param string $destination <p>
     * The destination path.
     * </p>
     *
     * @throws Error If path source or destination already exist.
     *
     * @return bool True on success, false otherwise.
     */
    public static function move (string $source, string $destination):bool {

        return !self::isFolder($source) || !self::isFolder($destination)
            ? throw new Error("Path $source or $destination already exist.")
            : rename($source, $destination);

    }

    /**
     * ### Creates folder
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $owner_permissions <p>
     * Folder owner permission.
     *
     * note: This parameter is ignored on Windows.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $owner_group_permissions <p>
     * Folder owner group permission.
     *
     * note: This parameter is ignored on Windows.
     * </p>
     * @param \FireHub\Support\Enums\FilePermission $global_permissions <p>
     * Everyone's permission.
     *
     * note: This parameter is ignored on Windows.
     * </p>
     *
     * @throws Error If we cannot convert octane to decimal number.
     * @throws Error If path already exist.
     *
     * @return bool True on success, false otherwise.
     */
    public static function create (string $path, FilePermission $owner_permissions = FilePermission::ALL, FilePermission $owner_group_permissions = FilePermission::ALL, FilePermission $global_permissions = FilePermission::ALL):bool {

        $mode = '0'.$owner_permissions->value.$owner_group_permissions->value.$global_permissions->value;

        $permissions = Data::getType($permissions = octdec($mode)) === DataType::INT ? $permissions : throw new Error("We cannot convert octane to decimal number for number $mode.");

        return !self::isFolder($path)
            ? mkdir($path, $permissions, true)
            : throw new Error("Path $path already exist.");

    }

    /**
     * ### Deletes folder
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not folder.
     *
     * @return bool True on success, false otherwise.
     */
    public static function delete (string $path):bool {

        return self::isFolder($path) ? rmdir($path) : throw new Error("Path $path is not folder.");

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
     * @param bool $hidden [optional] <p>
     * List hidden file as well.
     * </p>
     *
     * @throws Error When listing filenames in folder, maybe path $path is folder.
     *
     * @return array<int, string> The parent folder name of the given path.
     */
    public static function list (string $path, ?Order $order = null, bool $hidden = true):array {

        $order = match ($order) {
            Order::ASC => SCANDIR_SORT_ASCENDING,
            Order::DESC => SCANDIR_SORT_DESCENDING,
            default => SCANDIR_SORT_NONE
        };

        return ($filenames = scandir($path, $order))
            ? $hidden
                ? $filenames
                : Arr::filter($filenames, fn($value):bool => !Str::startsWith('.', $value))
            : throw new Error("Error listing filenames in folder, maybe path $path is folder.");

    }

}
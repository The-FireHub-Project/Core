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

use const FireHub\Initializers\Constants\DS;
use const PATHINFO_FILENAME;
use const PATHINFO_EXTENSION;

use function basename;
use function pathinfo;
use function decoct;
use function fileperms;
use function chmod;
use function octdec;
use function copy;
use function rename;
use function unlink;
use function filesize;

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
     * ### Checks if file is empty
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to check.
     * </p>
     *
     * @return bool True if file is empty, false otherwise.
     */
    public static function isEmpty (string $path):bool {

        return self::size($path) === 0;

    }

    /**
     * ### Returns parent folder name component of path
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not file.
     *
     * @return string The parent folder name of the given path.
     */
    public static function parentFolder (string $path):string {

        return self::isFile($path) ? Folder::parentFolder($path) : throw new Error("Path $path is not file.");

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

        $permissions = Data::getType($permissions = @fileperms($path)) === DataType::INT ? $permissions : throw new Error("We cannot read permissions for file $path.");

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

    /**
     * ### Copies file
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     * @param string $to <p>
     * The destination path. If dest is a URL, the copy operation may fail if the wrapper does not support overwriting of existing files.
     * If the destination file already exists, it will be overwritten.
     * </p>
     * @param bool $overwrite [optional] <p>
     * Is set to true, if file already exists will be overwritten with the new one.
     * </p>
     *
     * @throws Error If overwrite is off and path already exist.
     *
     * @return bool True on success, false otherwise.
     */
    public static function copy (string $path, string $to, bool $overwrite = true):bool {

        return $overwrite
            ? copy($path, $to.DS.self::basename($path))
            : (self::isFile($to.DS.self::basename($path))
                ? throw new Error("Path $path already exist.")
                : copy($path, $to.DS.self::basename($path))
            );

    }

    /**
     * ### Moves file
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     * @param string $to <p>
     * The destination path.
     * </p>
     * @param bool $overwrite [optional] <p>
     * Is set to true, if file already exists will be overwritten with the new one.
     * </p>
     *
     * @throws Error If overwrite is off and path already exist.
     *
     * @return bool True on success, false otherwise.
     */
    public static function move (string $path, string $to, bool $overwrite = true):bool {

        return $overwrite
            ? rename($path, $to.DS.self::basename($path))
            : (self::isFile($to.DS.self::basename($path))
                ? throw new Error("Path $path already exist.")
                : rename($path, $to.DS.self::basename($path))
            );

    }

    /**
     * ### Renames file
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     * @param string $new_basename $to <p>
     * New file base name (file name with extension).
     * </p>
     * @param bool $overwrite [optional] <p>
     * Is set to true, if file already exists will be overwritten with the new one.
     * </p>
     *
     * @throws Error If overwrite is off and path already exist.
     *
     * @return bool True on success, false otherwise.
     */
    public static function rename (string $path, string $new_basename, bool $overwrite = true):bool {

        return $overwrite
            ? rename($path, self::parentFolder($path).DS.$new_basename)
            : (self::isFile(self::parentFolder($path).DS.$new_basename)
                ? throw new Error("Path $path already exist.")
                : rename($path, self::parentFolder($path).DS.$new_basename)
            );

    }

    /**
     * ### Deletes file
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error If path is not file.
     *
     * @return bool True on success, false otherwise.
     */
    public static function delete (string $path):bool {

        return self::isFile($path) ? unlink($path) : throw new Error("Path $path is not file.");

    }

    /**
     * ### Gets file size
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $path <p>
     * Path to filename.
     * </p>
     *
     * @throws Error Cannot read path $path size.
     * @throws Error If path is not file.
     *
     * @return int The size of the file in bytes.
     */
    public static function size (string $path):int {

        if (($size = filesize($path)) === false) {throw new Error("Cannot read path $path size.");}

        return self::isFile($path) ? $size : throw new Error("Path $path is not file.");

    }

}
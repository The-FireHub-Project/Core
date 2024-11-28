<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Support
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Support\LowLevel;

use FireHub\Core\Support\Enums\ {
    Order, FileSystem\Permission
};
use FireHub\Core\Support\Exceptions\FileSystem\ {
    CannotListException, CreateFolderException, DeleteFolderException, DiskSpaceException, FindPathNamesException
};

use const GLOB_ONLYDIR;
use const SCANDIR_SORT_ASCENDING;
use const SCANDIR_SORT_DESCENDING;
use const SCANDIR_SORT_NONE;

use function glob;
use function disk_free_space;
use function disk_total_space;
use function is_dir;
use function mkdir;
use function rmdir;
use function scandir;

/**
 * ### Folder low-level proxy class
 *
 * Class contains methods related to folders.
 * @since 1.0.0
 *
 * @internal
 */
final class Folder extends FileSystem {

    /**
     * ### Tells whether the filename is a regular folder
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the folder.
     * If the filename is a relative filename, it will be checked relative to the current working folder.
     * If the filename is a symbolic or hard link, then the link will be resolved and checked.
     * If you've enabled open_basedir, further restrictions may apply.
     * </p>
     *
     * @error\exeption E_WARNING upon failure.
     *
     * @return bool True if the filename exists and is a regular folder, false otherwise.
     *
     * @note The results of this function are cached.
     * See [[FileSystem#clearCache()]] for more details.
     */
    public static function isFolder (string $path):bool {

        return is_dir($path);

    }

    /**
     * ### Makes folder
     *
     * Attempts to create the folder specified by $path.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\FileSystem\Permission As parameter.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::int() To find whether octdec() returns an integer.
     *
     * @param non-empty-string $path <p>
     * Path to folder ot disk partition.
     * </p>
     * @param \FireHub\Core\Support\Enums\FileSystem\Permission $owner <p>
     * File owner permission.
     * </p>
     * @param \FireHub\Core\Support\Enums\FileSystem\Permission $owner_group <p>
     * File owner group permission.
     * </p>
     * @param \FireHub\Core\Support\Enums\FileSystem\Permission $global <p>
     * Everyone's permission.
     * </p>
     * @param bool $recursive [optional] <p>
     * If true, then any parent folders to the $path specified will also be created, with the same permissions.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\CreateFolderException If we couldn't create a folder.
     *
     * @return true True on success.
     *
     * @todo Replace octdec with low level class.
     */
    public static function create (string $path, Permission $owner, Permission $owner_group, Permission $global, bool $recursive = false):true {

        return DataIs::int($permissions = octdec('0'.$owner->value.$owner_group->value.$global->value))
        && mkdir($path, $permissions, $recursive)
            ?: throw new CreateFolderException()
                ->withPath($path)
                ->withPermissions($permissions)
                ->withOwner($owner)
                ->withOwnerGroup($owner_group)
                ->withGlobal($global)
                ->withRecursive($recursive);

    }

    /**
     * ### Deletes folder
     *
     * Attempts to remove the folder named by $path.
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to folder.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\DeleteFolderException If we couldn't delete the folder.
     *
     * @return true True on success.
     */
    public static function delete (string $path):true {

        return rmdir($path)
            ?: throw new DeleteFolderException()->withPath($path);

    }

    /**
     * ### List files and folders inside the specified folder
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Order::ASC To list files and folders in ascending order.
     * @uses \FireHub\Core\Support\Enums\Order::DESC To list files and folders in descending order.
     *
     * @param non-empty-string $folder <p>
     * The folder that will be scanned.
     * </p>
     * @param null|\FireHub\Core\Support\Enums\Order $order [optional] <p>
     * Result order.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\CannotListException If $folder is empty, or we couldn't
     * list files and directories inside the specified folder.
     *
     * @return string[] An array of filenames.
     */
    public static function list (string $folder, ?Order $order = null):array {

        return scandir($folder, match ($order) {
            Order::ASC => SCANDIR_SORT_ASCENDING,
            Order::DESC => SCANDIR_SORT_DESCENDING,
            default => SCANDIR_SORT_NONE
        }) ?: throw new CannotListException()
                ->withPath($folder)
                ->withOrder($order);

    }

    /**
     * ### Find path-names matching a pattern
     *
     * This method searches for all the path-names matching patterns according to the rules used by the libc glob()
     * function, which is similar to the rules used by common shells.
     * @since 1.0.0
     *
     * @param non-empty-string $pattern <p>
     * The pattern.
     * No tilde expansion or parameter substitution is done.
     * - * – Matches zero or more characters.
     * - ? – Matches exactly one character (any character).
     * - [...] – Matches one character from a group of characters. If the first character is !, matches any character
     * not in the group.
     * - \ – Escapes the following character.
     * </p>
     * @param bool $only_folders [optional] <p>
     * Return only directory entries which match the pattern.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\FindPathNamesException If there was an error while searching
     * for a path.
     *
     * @return string[] An array containing the matched files/folders, an empty array if no file matched.
     *
     * @note This function will not work on remote files as the file to be examined must be accessible via the
     * server's filesystem.
     * @note This function isn't available on some systems (for example, old Sun OS).
     */
    public static function search (string $pattern, bool $only_folders = false):array {

        return glob($pattern, $only_folders ? GLOB_ONLYDIR : 0)
            ?: throw new FindPathNamesException()
                ->withPattern($pattern)
                ->withOnlyFolders($only_folders);

    }

    /**
     * ### Gets total size of a filesystem or disk partition
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to folder ot disk partition.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\DiskSpaceException If we couldn't get disk space for a path.
     *
     * @return float Returns the total number of bytes as a float.
     *
     * @note Given a filename instead of a folder, the behavior of the function is unspecified and may differ
     * between operating systems and PHP versions.
     * @note This function will not work on remote files as the file to be examined must be accessible via the
     * server's filesystem.
     */
    public static function totalSpace (string $path):float {

        return disk_total_space($path)
            ?: throw new DiskSpaceException()
                ->withPath($path)
                ->withMessage("Could not get disk space for path: {$path}.");

    }

    /**
     * ### Gets free space of a filesystem or disk partition
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to folder ot disk partition.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\DiskSpaceException If we couldn't get disk space for a path.
     *
     * @return float Returns the total free space of bytes as a float.
     *
     * @note Given a filename instead of a folder, the behavior of the function is unspecified and may differ
     * between operating systems and PHP versions.
     * @note This function will not work on remote files as the file to be examined must be accessible via the
     * server's filesystem.
     */
    public static function freeSpace (string $path):float {

        return disk_free_space($path)
            ?: throw new DiskSpaceException()
                ->withPath($path)
                ->withMessage("Could not get free disk space for path: {$path}.");

    }

}
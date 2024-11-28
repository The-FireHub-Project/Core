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

use FireHub\Core\Support\Exceptions\FileSystem\ {
    CopyPathException, CreateLinkException, DeletePathException, GetContentException, GetContentAsArrayException,
    GetPathSizeException, MoveUploadedFileException, PathDoesntExistException, PutContentException, ReadFileException
};

use const FireHub\Core\Support\Constants\Path\DS;
use const FILE_APPEND;
use const FILE_IGNORE_NEW_LINES;
use const FILE_SKIP_EMPTY_LINES;
use const LOCK_EX;

use function copy;
use function file;
use function file_get_contents;
use function file_put_contents;
use function filesize;
use function is_executable;
use function is_file;
use function is_uploaded_file;
use function link;
use function move_uploaded_file;
use function readfile;
use function unlink;

/**
 * ### File low-level proxy class
 *
 * Class contains methods related to files.
 * @since 1.0.0
 *
 * @internal
 */
final class File extends FileSystem {

    /**
     * ### Tells whether the path is a regular file
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     *
     * @error\exeption E_WARNING upon failure.
     *
     * @return bool True if the filename exists and is a regular file, false otherwise.
     *
     * @note Because PHP's integer type is signed and many platforms use 32bit integers, some filesystem functions
     * may return unexpected results for files which are larger than 2GB.
     * @note The results of this function are cached.
     * See [[FileSystem#clearCache()]] for more details.
     */
    public static function isFile (string $path):bool {

        return is_file($path);

    }

    /**
     * ### Tells whether the path is executable
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     *
     * @return bool True if the filename exists and is an executable file, false otherwise.
     *
     * @note On POSIX systems, a file is executable if the executable bit of the file permissions is set.
     * On Windows, a file is considered executable if it is a properly executable file as reported by the Win API
     * GetBinaryType(); for BC reasons, files with a .bat or .cmd extension are also considered executable.
     * @note The results of this function are cached.
     * See [[FileSystem#clearCache()]] for more details.
     */
    public static function isExecutable (string $path):bool {

        return is_executable($path);

    }

    /**
     * ### Tells whether the file was uploaded via HTTP POST
     *
     * Returns true if the file named by filename was uploaded via HTTP POST.
     * This is useful to help ensure that a malicious user hasn't tried to trick the script into working on files
     * upon which it shouldn't be working.
     * This sort of check is especially important if there is any chance that anything done with uploaded files could
     * reveal their contents to the user, or even to other users on the same system.
     * For proper working, the function [[File#isUploaded()]] needs an argument like $_FILES['userfile']['tmp_name'],
     * – the name of the uploaded file on the client's machine $_FILES['userfile']['name'] doesn't work.
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     *
     * @return bool True on success or false on failure.
     */
    public static function isUploaded (string $path):bool {

        return is_uploaded_file($path);

    }

    /**
     * ### Gets file size
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\GetPathSizeException If we couldn't get file size for a file.
     *
     * @return int The size of the file in bytes.
     *
     * @note Because PHP's integer type is signed and many platforms use 32bit integers, some filesystem functions
     * may return unexpected results for files which are larger than 2GB.
     * @note The results of this function are cached.
     * See [[FileSystem#clearCache()]] for more details.
     */
    public static function size (string $path):int {

        return ($size = filesize($path)) !== false
            ? $size : throw new GetPathSizeException()->withPath($path);

    }

    /**
     * ### Copies file
     *
     * Makes a copy of the file $path to $to.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Path\DS To separate folders.
     * @uses \FireHub\Core\Support\LowLevel\File::basename() To get a base name component of $to a path.
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     * @param string $to <p>
     * The destination path.
     * If dest is a URL, the copy operation may fail if the wrapper doesn't support overwriting of existing files.
     * If the destination file already exists, it will be overwritten.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\CopyPathException If we couldn't copy a file.
     *
     * @return void
     *
     * @warning If the destination file already exists, it will be overwritten.
     */
    public static function copy (string $path, string $to):void {

        copy($path, $to.DS.self::basename($path))
            ?: throw new CopyPathException()
                ->withPath($path)
                ->withDestination($to);

    }

    /**
     * ### Deletes a file
     *
     * Attempts to remove the folder named by $path.
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\DeletePathException If we couldn't delete the file.
     *
     * @return true True on success.
     */
    public static function delete (string $path):true {

        return unlink($path)
            ?: throw new DeletePathException()->withPath($path);

    }

    /**
     * ### Create a hard link
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     * @param string $link <p>
     * The link name.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\CreateLinkException If we couldn't create a hard link for a path.
     *
     * @return true True on success.
     *
     * @note This function will not work on remote files as the file to be examined must be accessible via the
     * server's filesystem.
     * @note For Windows only: This function requires PHP to run in an elevated mode or with the UAC disabled.
     */
    public static function link (string $path, string $link):true {

        return link($path, $link)
            ?: throw new CreateLinkException()
                ->withPath($path)
                ->withLink($link);

    }

    /**
     * ### Reads the entire file into a string
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path of the file to read.
     * </p>
     * @param int $offset [optional] <p>
     * The offset where the reading starts on the original stream.
     * Negative offsets count from the end of the stream.
     * Seeking ($offset) is not supported with remote files.
     * Attempting to seek on non-local files may work with small offsets, but this is unpredictable because it works
     * on the buffered stream.
     * </p>
     * @param null|non-negative-int $length [optional] <p>
     * Maximum length of data read. The default is to read until the end of the file is reached.
     * Note that this parameter is applied to the stream processed by the filters.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\GetContentException If we can't get content from a path.
     *
     * @return string The read data.
     *
     * @note If you're opening an URI with special characters, such as spaces, you need to encode the URI with
     * urlencode().
     */
    public static function getContent (string $path, int $offset = 0, ?int $length = null):string {

        return ($content = file_get_contents($path, false, null, $offset, $length)) !== false
            ? $content
            : throw new GetContentException()
                ->withPath($path)
                ->withOffset($offset)
                ->withLength($length);

    }

    /**
     * ### Reads the entire file into an array
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * Path to the file.
     * </p>
     * @param bool $skip_empty_lines [optional] <p>
     * Skip empty lines.
     * </p>
     * @param bool $ignore_new_lines [optional] <p>
     * Omit a newline at the end of each array element.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\GetContentAsArrayException If we can't get content from a path.
     *
     * @return string[] The file in an array.
     * Each element of the array corresponds to a line in the file, with the newline still attached.
     *
     * @warning When using SSL, Microsoft IIS will violate the protocol by closing the connection without sending a
     * close_notify indicator.
     * PHP will report this as "SSL: Fatal Protocol Error" when you reach the end of the data.
     * To work around this, the value of error_reporting should be lowered to a level that doesn't include warnings.
     * PHP can detect buggy IIS server software when you open the stream using the https:// wrapper and will suppress
     * the warning.
     * When using fsockopen() to create a ssl:// socket, the developer is responsible for detecting and suppressing
     * this warning.
     * @note Each line in the resulting array will include the line ending, unless $ignore_new_lines is used.
     * @tip If PHP doesn't properly recognize the line endings when reading files either on or created by a
     * Macintosh computer, enabling the auto_detect_line_endings runtime configuration option may help resolve the
     * problem.
     * @tip A URL can be used as a $path.
     */
    public static function getContentArray (string $path, bool $skip_empty_lines = false, bool $ignore_new_lines = false):array {

        return ($content = file($path, match (true) {
            $skip_empty_lines && $ignore_new_lines => FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES,
            $skip_empty_lines => FILE_SKIP_EMPTY_LINES,
            $ignore_new_lines => FILE_IGNORE_NEW_LINES,
            default => 0
        })) !== false
            ? $content : throw new GetContentAsArrayException()
                ->withPath($path)
                ->withSkipEmptyLines($skip_empty_lines)
                ->withIgnoreNewLines($ignore_new_lines);

    }

    /**
     * ### Write data to a file
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\File::isFile() To tell whether the $file is a regular file.
     *
     * @param non-empty-string $path <p>
     * Path to the file where to write the data.
     * </p>
     * @param string[]|string $data <p>
     * The data to write.
     * </p>
     * @param bool $append [optional] <p>
     * Append the data to the file instead of overwriting it.
     * </p>
     * @param bool $lock [optional] <p>
     * Acquire an exclusive lock on the file while proceeding to the writing.
     * </p>
     * @param bool $create_file [optional] <p>
     * Is true, the method will create a new file if one doesn't exist.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\PathDoesntExistException If $path is not file.
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\PutContentException If the $create_file option is off or
     * couldn't put content on a path.
     *
     * @return non-negative-int The number of bytes that were written to the file false otherwise.
     */
    public static function putContent (string $path, array|string $data, bool $append = false, bool $lock = true, bool $create_file = false):int {

        if (!$create_file && !self::isFile($path)) throw new PathDoesntExistException()->withPath($path);

        return file_put_contents($path, $data, match (true) {
            $append && $lock => FILE_APPEND | LOCK_EX,
            $append => FILE_APPEND,
            $lock => LOCK_EX,
            default => 0
        }) ?: throw new PutContentException()
                ->withPath($path)
                ->withData($data)
                ->withAppend($append)
                ->withLock($lock)
                ->withCreateFile($create_file);

    }

    /**
     * ### Outputs a file
     *
     * Reads a file and writes it to the output buffer.
     * @since 1.0.0
     *
     * @param non-empty-string $path <p>
     * The filename path being read.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\ReadFileException If we couldn't put a read file on a path,
     * or a path is empty.
     *
     * @return int The number of bytes read from the file.
     *
     * @note [[File#read()]] will not present any memory issues, even when sending large files, on its own.
     * If you encounter an out-of-memory error, ensures that output buffering is off with ob_get_level().
     */
    public static function read (string $path):int {

        return readfile($path)
            ?: throw new ReadFileException()->withPath($path);

    }

    /**
     * ### Moves an uploaded file to a new location
     *
     * This function checks to ensure that the file designated by $from is a valid upload file (meaning that it was
     * uploaded via PHP's HTTP POST upload mechanism).
     * If the file is valid, it will be moved to the filename given by $to.
     * @since 1.0.0
     *
     * @param non-empty-string $from <p>
     * Filename of the uploaded file.
     * </p>
     * @param non-empty-string $to <p>
     * Destination of the moved file.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\FileSystem\MoveUploadedFileException If we couldn't move the uploaded
     * file.
     *
     * @return true True on success.
     *
     * @warning If the destination file already exists, it will be overwritten.
     * @note [[File#moveUploaded()]] is open_basedir aware.
     * However, restrictions are placed only on the path as to allow moving of uploaded files in which from may
     * conflict with such restrictions.
     * [[File#moveUploaded()]] ensures the safety of this operation by allowing only those files uploaded through PHP
     * to be moved.
     */
    public static function moveUploaded (string $from, string $to):true {

        return move_uploaded_file($from, $to)
            ?: throw new MoveUploadedFileException()
                ->withPath($from)
                ->withDestination($to);

    }

}
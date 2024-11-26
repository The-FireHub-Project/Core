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

use FireHub\Core\Support\Exceptions\ {
    DataException, Str\EmptySeparatorException
};
use Error, Stringable, ValueError;

use const FireHub\Core\Support\Constants\Number\MAX;

use function addslashes;
use function explode;
use function implode;
use function quotemeta;
use function str_contains;
use function str_ends_with;
use function str_repeat;
use function str_starts_with;
use function strcmp;
use function strip_tags;
use function stripslashes;
use function strtr;

/**
 * ### Safe string low-level proxy class
 *
 * Class contains methods that are safe to use on normal as well as on multibyte encoding.
 * @since 1.0.0
 *
 * @internal
 */
abstract class StrSafe {

    /**
     * ### Checks if string contains a value
     *
     * Performs a case-sensitive check indicating if $string is contained in $string.
     * @since 1.0.0
     *
     * @param string $value <p>
     * The value to search for.
     * </p>
     * @param string $string <p>
     * The string to search in.
     * </p>
     *
     * @return bool True if a string contains a value, false otherwise.
     */
    final public static function contains (string $value, string $string):bool {

        return str_contains($string, $value);

    }

    /**
     * ### Checks if a string starts with a given value
     *
     * Performs a case-sensitive check indicating if $string begins with $value.
     * @since 1.0.0
     *
     * @param non-empty-string $value <p>
     * The value to search for.
     * </p>
     * @param string $string <p>
     * The string to search in.
     * </p>
     *
     * @return bool True if the string starts with value, false otherwise.
     */
    final public static function startsWith (string $value, string $string):bool {

        return $value && str_starts_with($string, $value);

    }

    /**
     * ### Checks if a string ends with a given value
     *
     * Performs a case-sensitive check indicating if $string ends with $value.
     * @since 1.0.0
     *
     * @param non-empty-string $value <p>
     * The value to search for.
     * </p>
     * @param string $string <p>
     * The string to search in.
     * </p>
     *
     * @return bool True if the string ends with value, false otherwise.
     */
    final public static function endsWith (string $value, string $string):bool {

        return $value && str_ends_with($string, $value);

    }

    /**
     * ### Quote string with slashes
     *
     * Backslashes are added before characters that need to be escaped:
     * (single quote, double quote, backslash, NUL).
     * @since 1.0.0
     *
     * @param string $string <p>
     * The string to be escaped.
     * </p>
     *
     * @return string The escaped string.
     *
     * @caution The [[StrSafe#addSlashes()]] is sometimes incorrectly used to try to prevent SQL Injection.
     * Instead, database-specific escaping functions and/or prepared statements should be used.
     */
    public static function addSlashes (string $string):string {

        return addslashes($string);

    }

    /**
     * ### Join array elements with a string
     *
     * Join array elements with a $separator string.
     * @since 1.0.0
     *
     * @param array<array-key, null|scalar|Stringable> $array <p>
     * The array of strings to implode.
     * </p>
     * @param string $separator [optional] <p>
     * The boundary string.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\DataException If the array item couldn't be converted to string.
     *
     * @return string Returns a string containing a string representation of all the array elements in the same order,
     * with the separator string between each element.
     */
    final public static function implode (array $array, string $separator = ''):string {

        try {

            return implode($separator, $array);

        } catch (Error $error) {

            throw new DataException()->withMessage($error->getMessage());


        }

    }

    /**
     * ### Quote meta-characters
     *
     * Returns a version of str with a backslash character (\) before every character that is among these: .\+*?[^]($).
     * @since 1.0.0
     *
     * @param string $string <p>
     * The input string.
     * </p>
     *
     * @return string The string with meta-characters quoted.
     */
    final public static function quoteMeta (string $string):string {

        return quotemeta($string);

    }

    /**
     * ### Repeat a string
     *
     * Returns string repeated $times times.
     * @since 1.0.0
     *
     * @param string $string <p>
     * The string is to be repeated.
     * </p>
     * @param int $times <p>
     * Number of time the input string should be repeated.
     * Multiplier has to be greater than or equal to 0.
     * If the $times are set to 0 or less, the function will return an empty string.
     * </p>
     * @param string $separator [optional] <p>
     * Separator in between any repeated string.
     * </p>
     *
     * @return string Repeated string.
     *
     * @note If $times is less than 1, the original string will be returned.
     */
    final public static function repeat (string $string, int $times, string $separator = ''):string {

        return $times < 1 ? '' : str_repeat($string.$separator, $times - 1).$string;

    }

    /**
     * ### Strip HTML and PHP tags from a string
     *
     * This function tries to return a string with all NULL bytes, HTML and PHP tags stripped from a given string.
     * It uses the same tag stripping state machine as the fgetss() function.
     * @since 1.0.0
     *
     * @param string $string <p>
     * The input string.
     * </p>
     * @param null|string|array<int, string> $allowed_tags <p>
     * You can use the optional second parameter to specify tags which shouldn't be stripped.
     *
     * @return string the Stripped string.
     *
     * @note Self-closing XHTML tags are ignored, and only non-self-closing tags should be used in allowed_tags.
     * For example, to allow both <br> and <br/>, you should use: <br>.
     * </p>
     */
    public static function stripTags (string $string, null|string|array $allowed_tags = null):string {

        return strip_tags($string, $allowed_tags);

    }

    /**
     * ### Unquotes a quoted string
     *
     * Backslashes are removed: (backslashes become single quote, double backslashes are made into a single backslash).
     * @since 1.0.0
     *
     * @param string $string <p>
     * The string to be unquoted.
     * </p>
     *
     * @return string String with backslashes stripped off.
     *
     * @note [[StrSafe#stripSlashes()]] is not recursive.
     * If you want to apply this function to a multidimensional array, you need to use a recursive function.
     * @tip [[StrSafe#stripSlashes()]] can be used if you aren't inserting this data into a place (such as a database)
     * that requires escaping.
     * For example, if you're simply outputting data straight from an HTML form.
     */
    public static function stripSlashes (string $string):string {

        return stripslashes($string);

    }

    /**
     * ### Split a string by a string
     *
     * Returns an array of strings, each of which is a substring of string formed by splitting it on boundaries
     * formed by the string separator.
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Number\MAX To set the limit of returned array size to maximum.
     *
     * @param string $string <p>
     * The input string.
     * </p>
     * @param non-empty-string $separator <p>
     * The boundary string.
     * </p>
     * @param int<min, max> $limit [optional] <p>
     * If the limit is set and positive, the returned array will contain a maximum of limit elements with the last
     * element containing the rest of the string.
     * If the limit parameter is negative, all components except the last – limit are returned.
     * If the limit parameter is zero, then this is treated as 1.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Str\EmptySeparatorException If the separator is an empty string.
     *
     * @return string[] If a delimiter contains a value not contained in string, and a negative limit is used,
     * then an empty array will be returned.
     * For any other limit, an array containing string will be returned.
     */
    final public static function explode (string $string, string $separator, int $limit = MAX):array {

        try {

            return explode($separator, $string, $limit);

        } catch (ValueError) {

            throw new EmptySeparatorException($string);


        }

    }

    /**
     * ### String comparison
     * @since 1.0.0
     *
     * @param string $string_1 <p>
     * String to compare against.
     * </p>
     * @param string $string_2 <p>
     * String to compare with.
     * </p>
     *
     * @return int<-1, 1> -1 if string1 is less than string2; 1 if string1 is greater than string2, and 0 if they are
     * equal.
     *
     * @note This comparison is case-sensitive.
     */
    public static function compare (string $string_1, string $string_2):int {

        return strcmp($string_1, $string_2) <=> 0;

    }

    /**
     * ### Translate characters or replace substrings
     * @since 1.0.0
     *
     * @param string $string <p>
     * The string being translated to.
     * </p>
     * @param array<non-empty-string, string> $replace_pairs <p>
     * An array of key-value pairs for translation.
     * </p>
     *
     * @return string The translated string.
     */
    public static function translate (string $string, array $replace_pairs):string {

        return strtr($string, $replace_pairs);

    }

}
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

use FireHub\Support\Enums\ {
    DataType, Encoding, Side, StrCase
};
use Error;

use const ENT_QUOTES;
use const ENT_SUBSTITUTE;
use const ENT_HTML401;

use function is_string;
use function settype;
use function str_contains;
use function str_starts_with;
use function str_ends_with;
use function str_replace;
use function str_ireplace;
use function str_pad;
use function str_repeat;
use function mb_strlen;
use function mb_str_split;
use function implode;
use function explode;
use function strcmp;
use function strcasecmp;
use function mb_strstr;
use function mb_stristr;
use function mb_strrchr;
use function mb_strrichr;
use function strpbrk;
use function strspn;
use function strcspn;
use function is_int;
use function strip_tags;
use function mb_strpos;
use function mb_stripos;
use function stripslashes;
use function mb_substr;
use function mb_substr_count;
use function strtr;
use function ltrim;
use function rtrim;
use function trim;
use function wordwrap;
use function mb_convert_encoding;
use function mb_detect_encoding;
use function htmlentities;
use function html_entity_decode;
use function ord;
use function chr;
use function str_word_count;
use function mb_convert_case;

/**
 * ### String low level class
 * @since 0.2.0.pre-alpha.M2
 *
 * @package FireHub\Support
 */
final class Str {

    /**
     * ### Checks if value is string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if value is string, false otherwise.
     */
    public static function isString (mixed $value):bool {

        return is_string($value);

    }

    /**
     * ### Convert value to string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param mixed $value <p>
     * Value to convert.
     * </p>
     *
     * @return string String representation of value.
     */
    public static function toString (mixed $value):string {

        settype($value, DataType::STRING->value);

        /**
         * PHPStan stan reports value might not be string type
         * @phpstan-ignore-next-line
         */
        return $value;

    }

    /**
     * ### Checks if value is empty
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $value <p>
     * Value to check.
     * </p>
     *
     * @return bool True if string is empty, false otherwise.
     */
    public static function isEmpty (string $value):bool {

        return empty($value);

    }

    /**
     * ### Checks if string contains value
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $value <p>
     * The value to search for.
     * </p>
     * @param string $string <p>
     * The string to search in.
     * </p>
     *
     * @return bool True if string contains value, false otherwise.
     */
    public static function contains (string $value, string $string):bool {

        return str_contains($string, $value);

    }

    /**
     * ### Checks if a string starts with a given value
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $value <p>
     * The value to search for.
     * </p>
     * @param string $string <p>
     * The string to search in.
     * </p>
     *
     * @return bool True if string starts with value, false otherwise.
     */
    public static function startsWith (string $value, string $string):bool {

        return str_starts_with($string, $value);

    }

    /**
     * ### Checks if a string ends with a given value
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $value <p>
     * The value to search for.
     * </p>
     * @param string $string <p>
     * The string to search in.
     * </p>
     *
     * @return bool True if string ends with value, false otherwise.
     */
    public static function endsWith (string $value, string $string):bool {

        return str_ends_with($string, $value);

    }

    /**
     * ### Checks if a string ends with a given value
     *
     * Note that multibyte characters may not work as expected while $case_sensitive is on.
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The value being searched for. An array may be used to designate multiple needles.
     * </p>
     * @param string|array<string> $search <p>
     * The replacement value that replaces found search values.
     * An array may be used to designate multiple replacements.
     * </p>
     * @param string|array<string> $replace <p>
     * The string being searched and replaced on.
     * </p>
     * @param bool $case_sensitive [optional] <p>
     * Searched values are case-insensitive.
     * </p>
     * @param null|bool &$count [optional] <p>
     * If passed, this will hold the number of matched and replaced needles.
     * </p>
     *
     * @return string String with the replaced values.
     */
    public static function replace (string $string, string|array $search, string|array $replace, bool $case_sensitive = true, ?bool &$count = null):string {

        if ($case_sensitive) return str_replace($search, $replace, $string, $count);

        return str_ireplace($search, $replace, $string, $count);

    }

    /**
     * ### Pad a string to a certain length with another string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string being padded.
     * </p>
     * @param int $length <p>
     * If the value of pad_length is negative, less than, or equal to the length of the input string, no padding takes place.
     * </p>
     * @param string $pad_string [optional] <p>
     * The pad_string may be truncated if the required number of padding characters can't be evenly divided by the pad_string's length.
     * </p>
     * @param \FireHub\Support\Enums\Side $side [optional] <p>
     * Pad side.
     * </p>
     *
     * @return string Padded string.
     */
    public static function pad (string $string, int $length, string $pad_string = " ", Side $side = Side::RIGHT):string {

        return str_pad($string, $length, $pad_string, $side->value);

    }

    /**
     * ### Repeat a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to be repeated.
     * </p>
     * @param int $times <p>
     * Number of time the input string should be repeated.
     * Multiplier has to be greater than or equal to 0. If the multiplier is set to 0, the function will return an empty string.
     * </p>
     *
     * @return string Repeated string.
     */
    public static function repeat (string $string, int $times):string {

        return str_repeat($string, $times);

    }

    /**
     * ### Perform the rot transform on a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to perform rot on.
     * </p>
     * @param int $number <p>
     * Number of letters to shift for every letter.
     * </p>
     *
     * @return string Rot version of the given string.
     */
    public static function rot (string $string, int $number):string {

        $rot = '';

        for ($count = 0, $length = self::length($string); $count < $length; $count++) {

            // get the ASCII character for the current character
            $char = self::ord($string[$count]);

            // if that character is in the range A-Z or a-z, add $number to its ASCII value
            if (($char >= 65 && $char <= 90) || ($char >= 97 && $char <= 122)) {

                $char += $number;

                // if we should have wrapped around the alphabet, subtract $number * 2
                if ($char > 122 || ($char > 90 && self::ord($string[$count]) <= 90)) $char -= $number * 2;

            }

            $rot .= self::chr($char);

        }

        return $rot;

    }

    /**
     * ### Get string length
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string being measured for length.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return int<0, max> String length.
     */
    public static function length (string $string, ?Encoding $encoding = null):int {

        return mb_strlen($string, $encoding?->value);

    }

    /**
     * ### Randomly shuffles a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string being shuffled.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string The shuffled string.
     */
    public static function shuffle (string $string, ?Encoding $encoding = null):string {

        $split = self::split($string, 1, $encoding);

        Arr::shuffle($split);

        return self::implode($split);

    }

    /**
     * ### Convert a string to an array
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string being split.
     * </p>
     * @param int<1, max> $length [optional] <p>
     * If specified, each element of the returned array will be composed of multiple characters instead of a single character.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return array<int, string> If the optional length parameter is specified, the returned array will be broken down into chunks with each being length in length, except the final chunk which may be shorter if the string does not divide evenly. The default length is 1, meaning every chunk will be one byte in size.
     */
    public static function split (string $string, int $length = 1, ?Encoding $encoding = null):array {

        return mb_str_split($string, $length, $encoding?->value);

    }

    /**
     * ### Split a string by a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * String being exploded.
     * </p>
     * @param string $separator <p>
     * The boundary string.
     * </p>
     * @param int $limit [optional] <p>
     * If limit is set and positive, the returned array will contain a maximum of limit elements with the last element containing the rest of string.
     * If the limit parameter is negative, all components except the last -limit are returned.
     * If the limit parameter is zero, then this is treated as 1.
     * </p.
     *
     * @return string[] If delimiter contains a value that is not contained in string and a negative limit is used, then an empty array will be returned. For any other limit, an array containing string will be returned.
     */
    public static function explode (string $string, string $separator, int $limit = PHP_INT_MAX):array {

        /**
         * PHPStan stan reports that $separator could be empty, but it is checked bellow.
         * @phpstan-ignore-next-line
         */
        return explode((!self::isEmpty($separator) ? $separator : throw new Error('String is empty')), $string, $limit);

    }

    /**
     * ### Join array elements with a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string[] $array <p>
     * The array of strings to implode.
     * </p>
     * @param string $separator [optional] <p>
     * Defaults to an empty string. This is not the preferred usage of implode as glue would be the second parameter and thus,
     * the bad prototype would be used.
     * </p>
     *
     * @return string A string containing a string representation of all the array elements in the same order, with the glue string between each element.
     */
    public static function implode (array $array, string $separator = ''):string {

        return implode($separator, $array);

    }

    /**
     * ### Compare two strings
     *
     * Please note that multibyte case-sensitive comparison is not
     * possible currently.
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string_1 <p>
     * String to compare against.
     * </p>
     * @param string $string_2 <p>
     * String to compare with.
     * </p>
     * @param bool $case_sensitive [optional] <p>
     * Is comparison case-sensitive or not.
     * </p>
     *
     * @return bool True if two strings are same, false otherwise.
     */
    public static function compare (string $string_1, string $string_2, bool $case_sensitive = false):bool {

        if ($case_sensitive) return strcmp($string_1, $string_2) === 0;

        return strcasecmp(self::toUpper($string_1), self::toUpper($string_2)) === 0;

    }

    /**
     * ### Make a string lowercase
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string being lowercased.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string String with all alphabetic characters converted to lowercase.
     */
    public static function toLower (string $string, ?Encoding $encoding = null):string {

        return self::convert($string, StrCase::LOWER, $encoding);

    }

    /**
     * ### Make a string uppercase
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string being uppercased.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string String with all alphabetic characters converted to uppercase.
     */
    public static function toUpper (string $string, ?Encoding $encoding = null):string {

        return self::convert($string, StrCase::UPPER, $encoding);

    }

    /**
     * ### Capitalize every word from string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * String to capitalize every word.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string Capitalize string.
     */
    public static function toTitle (string $string, ?Encoding $encoding = null):string {

        return self::convert($string, StrCase::TITLE, $encoding);

    }

    /**
     * ### Capitalize string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * String to capitalize.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string Capitalized string.
     */
    public static function capitalize (string $string, ?Encoding $encoding = null):string {

        return self::toUpper(self::part($string, 0, 1), $encoding).self::part($string, 1, null, $encoding);

    }

    /**
     * ### De-capitalize string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * String to de-capitalize.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string De-capitalized string.
     */
    public static function deCapitalize (string $string, ?Encoding $encoding = null):string {

        return self::toLower(self::part($string, 0, 1), $encoding).self::part($string, 1, null, $encoding);

    }

    /**
     * ### Find first part of a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $find <p>
     * String to find.
     * </p>
     * @param string $string <p>
     * The string being searched.
     * </p>
     * @param bool $before_needle [optional] <p>
     * If true, returns the part of the string before the first occurrence (excluding the find string).
     * </p>
     * @param bool $case_sensitive [optional] <p>
     * Is string to find case-sensitive or not.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string|false The portion of string, or false if needle is not found.
     */
    public static function firstPart (string $find, string $string, bool $before_needle = false, bool $case_sensitive = true, ?Encoding $encoding = null):string|false {

        if ($case_sensitive) return mb_strstr($string, $find, $before_needle, $encoding?->value);

        return mb_stristr($string, $find, $before_needle, $encoding?->value);

    }

    /**
     * ### Find last part of a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $find <p>
     * String to find.
     * </p>
     * @param string $string <p>
     * The string being searched.
     * </p>
     * @param bool $before_needle [optional] <p>
     * If true, returns the part of the string before the last occurrence (excluding the find string).
     * </p>
     * @param bool $case_sensitive [optional] <p>
     * Is string to find case-sensitive or not.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string|false The portion of string, or false if needle is not found.
     */
    public static function lastPart (string $find, string $string, bool $before_needle = false, bool $case_sensitive = true, ?Encoding $encoding = null):string|false {

        if ($case_sensitive) return mb_strrchr($string, $find, $before_needle, $encoding?->value);

        return mb_strrichr($string, $find, $before_needle, $encoding?->value);

    }

    /**
     * ### Find part of a string with characters
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $characters <p>
     * Characters to find.
     *
     * This parameter is case-sensitive.
     * </p>
     * @param string $string <p>
     * The string being searched.
     * </p>
     *
     * @return string|false
     */
    public static function partFrom (string $characters, string $string):string|false {

        return strpbrk($string, $characters);

    }

    /**
     * ### Finds the length of the initial segment of a string consisting entirely of characters contained within a given mask
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to examine.
     * </p>
     * @param string $characters <p>
     * The list of allowable characters.
     * </p>
     * @param int $offset [optional] <p>
     * The position in subject to start searching.
     * If start is given and is non-negative, then strspn will begin examining subject at the start position. For instance, in the string 'abcdef', the character at position 0 is 'a', the character at position 2 is 'c', and so forth.
     * If start is given and is negative, then strspn will begin examining subject at the start position from the end of subject.
     * </p>
     * @param int|null $length [optional] <p>
     * The length of the segment from subject to examine.
     * If length is given and is non-negative, then subject will be examined for length characters after the starting position.
     * If length is given and is negative, then subject will be examined from the starting position up to length characters from the end of subject.
     * </p>
     *
     * @return int The length of the initial segment of string which consists entirely of characters in characters.
     */
    public static function segmentMatching (string $string, string $characters, int $offset = 0, ?int $length = null):int {

        return strspn($string, $characters, $offset, $length);

    }

    /**
     * ### Find length of initial segment not matching mask
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to examine.
     * </p>
     * @param string $characters <p>
     * The string containing every disallowed character.
     * </p>
     * @param int $offset [optional] <p>
     * The position in subject to start searching.
     * If start is given and is non-negative, then strspn will begin examining subject at the start position. For instance, in the string 'abcdef', the character at position 0 is 'a', the character at position 2 is 'c', and so forth.
     * If start is given and is negative, then strspn will begin examining subject at the start position from the end of subject.
     * </p>
     * @param int|null $length [optional] <p>
     * The length of the segment from subject to examine.
     * If length is given and is non-negative, then subject will be examined for length characters after the starting position.
     * If length is given and is negative, then subject will be examined from the starting position up to length characters from the end of subject.
     * </p>
     *
     * @return int The length of the initial segment of string which consists entirely of characters not in characters.
     */
    public static function segmentNotMatching (string $string, string $characters, int $offset = 0, ?int $length = null):int {

        return strcspn($string, $characters, $offset, $length);

    }

    /**
     * ### Count number of words in string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A string to search words.
     * </p>
     * @param null|string $characters [optional] <p>
     * A list of additional characters which will be considered as 'word'.
     * </p>
     *
     * @return int Number of words found.
     */
    public static function countWords (string $string, ?string $characters = null):int {

        return is_int($count = self::wordCount($string, 0, $characters)) ? $count : 0;

    }

    /**
     * ### Count character in string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A string to count characters.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return array<array-key, int<0, max>> List of found characters.
     */
    public static function countCharacters (string $string, ?Encoding $encoding = null):array {

        $length = self::length($string, $encoding);

        $unique = [];
        for ($count = 0; $count < $length; $count++) {

            $character = self::part($string, $count, 1, $encoding);

            if (!Arr::keyExist($character, $unique)) $unique[$character] = 0;

            $unique[$character]++;

        }

        return $unique;

    }

    /**
     * ### List of words in string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A string to search words.
     * </p>
     * @param null|string $characters [optional] <p>
     * A list of additional characters which will be considered as 'word'.
     * </p>
     *
     * @return array<int, string> List of words.
     */
    public static function words (string $string, ?string $characters = null):array {

        return Arr::isArray($array = self::wordCount($string, 1, $characters)) ? $array : [];

    }

    /**
     * ### Strip HTML and PHP tags from a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A string to strip tags.
     * </p>
     * @param null|string|string[] $allowed_tags <p>
     * Specify tags which should not be stripped.
     * </p>
     *
     * @return string the Stripped string.
     */
    public static function stripTags (string $string, null|string|array $allowed_tags = null):string {

        return strip_tags($string, $allowed_tags);

    }

    /**
     * ### Find the position of the first occurrence of a substring in a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $search <p>
     * A string to find position.
     * </p>
     * @param string $string <p>
     * The string to search in.
     * </p>
     * @param int $offset [optional] <p>
     * If specified, search will start this number of characters counted from the beginning of the string.
     * </p>
     * @param bool $case_sensitive [optional] <p>
     * Search case-sensitive position.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return int|false Numeric position of the first occurrence or false if none exist.
     */
    public static function position (string $search, string $string, int $offset = 0, bool $case_sensitive = true, ?Encoding $encoding = null):int|false {

        if ($case_sensitive) return mb_strpos($string, $search, $offset, $encoding?->value);

        return mb_stripos($string, $search, $offset, $encoding?->value);

    }

    /**
     * ### Un-quotes a quoted string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A string to un-quote.
     * </p>
     *
     * @return string A string with backslashes stripped off. (\' becomes ' and so on.) Double backslashes (\\) are made into a single backslash (\).
     */
    public static function stripSlashes (string $string):string {

        return stripslashes($string);

    }

    /**
     * ### Get part of string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to extract the substring from.
     * </p>
     * @param int $start <p>
     * If start is non-negative, the returned string will start at the start position in string, counting from zero.
     * For instance, in the string 'abcdef', the character at position 0 is 'a', the character at position 2 is 'c', and so forth.
     * If start is negative, the returned string will start at the start character from the end of string.
     * </p>
     * @param null|int $length [optional] <p>
     * Maximum number of characters to use from string.
     * If omitted or NULL is passed, extract all characters to the end of the string.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string The portion of string specified by the start and length parameters.
     */
    public static function part (string $string, int $start, ?int $length = null, ?Encoding $encoding = null) {

        return mb_substr($string, $start, $length, $encoding?->value);

    }

    /**
     * ### Get part of string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string being checked.
     * </p>
     * @param string $search <p>
     * The string being found.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return int Number of times the searched substring occurs in the string.
     */
    public static function partCount (string $string, string $search, ?Encoding $encoding = null):int {

        return mb_substr_count($string, $search, $encoding?->value);

    }

    /**
     * ### Reverse a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A string to reverse.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string Reversed string.
     */
    public static function reverse (string $string, ?Encoding $encoding = null):string {

        $reversed = '';

        for ($count = self::length($string, $encoding); $count >= 0; $count--) {

            $reversed .= self::part($string, $count, 1, $encoding);

        }

        return $reversed;

    }

    /**
     * ### Translate a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A string to translate.
     * </p>
     * @param array<string, string> $pairs <p>
     * An array of key-value pairs for translation.
     * </p>
     *
     * @return string Translated string.
     */
    public static function translate (string $string, array $pairs):string {

        return strtr($string, $pairs);

    }

    /**
     * ### Strip whitespace (or other characters) from the beginning and end of a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string that will be trimmed.
     * </p>
     * @param \FireHub\Support\Enums\Side $side [optional] <p>
     * Side to trim string.
     * </p>
     * @param string $characters [optional] <p>
     * The stripped characters can also be specified using the char-list parameter.
     * Simply list all characters that you want to be stripped.
     * </p>
     *
     * @return string The trimmed string.
     */
    public static function trim (string $string, Side $side = Side::BOTH, string $characters = " \n\r\t\v\x00"):string {

        return match($side) {
            Side::LEFT => ltrim($string, $characters),
            Side::RIGHT => rtrim($string, $characters),
            default => trim($string, $characters)
        };

    }

    /**
     * ### Wraps a string to a given number of characters
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to warp.
     * </p>
     * @param int $width [optional] <p>
     * The column width.
     * </p>
     * @param string $break [optional] <p>
     * The line is broken using the optional break parameter.
     * </p>
     * @param bool $cut_long_words [optional] <p>
     * If the cut is set to true, the string is always wrapped at or before the specified width.
     * So if you have a word that is larger than the given width, it is broken apart.
     * </p>
     *
     * @return string The given string wrapped at the specified column.
     */
    public static function wrap (string $string, int $width = 75, string $break = "\n", bool $cut_long_words = false):string {

        return wordwrap($string, $width, $break, $cut_long_words);

    }

    /**
     * ### Convert a string from one character encoding to another
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to be converted.
     * </p>
     * @param \FireHub\Support\Enums\Encoding $to <p>
     * The desired encoding of the result.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $from [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string|false Encoded string or false on failure.
     */
    public static function convertEncoding (string $string, Encoding $to, ?Encoding $from = null):string|false {

        return mb_convert_encoding($string, $to->value, $from?->value);

    }

    /**
     * ### Detect character encoding
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * The string to detect encoding.
     * </p>
     *
     * @return string|false The detected character encoding, or false if the string is not valid in any of the listed encodings.
     */
    public static function detectEncoding (string $string):string|false {

        $cases = [];
        foreach (Encoding::cases() as $case) {

            $cases[] = $case->value;

        }

        return mb_detect_encoding($string, $cases, true);

    }

    /**
     * ### Convert all applicable characters to HTML entities
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * String to encode.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string The encoded string.
     */
    public static function htmlEncode (string $string, ?Encoding $encoding = null):string {

        return htmlentities($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, $encoding?->value);

    }

    /**
     * ### Convert HTML entities to their corresponding characters
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * String to decode.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string The decoded string.
     */
    public static function htmlDecode (string $string, ?Encoding $encoding = null):string {

        return html_entity_decode($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, $encoding?->value);

    }

    /**
     * ### Convert the first byte of a string to a value between 0 and 255
     * @since 0.2.0.pre-alpha.M2
     *
     * @param string $string <p>
     * A character.
     * </p>
     *
     * @return int The ASCII value as an integer.
     */
    public static function ord (string $string):int {

        return ord($string);

    }

    /**
     * ### Generate a single-byte string from a number
     * @since 0.2.0.pre-alpha.M2
     *
     * @param int $number <p>
     * The ASCII code.
     * </p>
     *
     * @return string The specified character.
     */
    public static function chr (int $number):string {

        return chr($number);

    }

    /**
     * @param string $string <p>
     * A string to search words.
     * </p>
     * @param int<0, 2> $format [optional] <p>
     * A string to search words.
     * </p>
     * @param null|string $characters [optional] <p>
     * A list of additional characters which will be considered as 'word'.
     * </p>
     *
     * @return int<0, max>|array<int, string> Number of words found or list of words.
     */
    private static function wordCount (string $string, int $format = 0, ?string $characters = null):int|array {

        /**
         * PHPStan stan reports that function returns array<int, string>|int|false.
         * @phpstan-ignore-next-line
         */
        return str_word_count($string, $format, $characters);

    }

    /**
     * ### Perform case folding on a string
     * @since 0.2.0.pre-alpha.M2
     *
     * @param $string <p>
     * The string being converted.
     * </p>
     * @param \FireHub\Support\Enums\StrCase $case <p>
     * The mode of the conversion.
     * </p>
     * @param null|\FireHub\Support\Enums\Encoding $encoding [optional] <p>
     * Character encoding. If it is null, the internal character encoding value will be used.
     * </p>
     *
     * @return string Converted string.
     */
    private static function convert (string $string, StrCase $case, ?Encoding $encoding = null):string {

        return mb_convert_case($string, $case->value, $encoding?->value);

    }

}
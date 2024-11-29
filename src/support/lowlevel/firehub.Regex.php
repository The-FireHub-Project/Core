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

use FireHub\Core\Support\Exceptions\Regex\ {
    ReplaceException, SplitException
};

use const PREG_SPLIT_NO_EMPTY;

use function preg_match;
use function preg_match_all;
use function preg_replace;
use function preg_replace_callback;
use function preg_split;
use function preg_quote;

/**
 * ### Regex low-level proxy class
 *
 * The syntax for patterns used in these functions closely resembles Perl.
 * The expression must be enclosed in the delimiters, a forward slash (/), for example.
 * Delimiters can be any non-alphanumeric, non-whitespace ASCII character except the backslash (\) and the null byte.
 * If the delimiter character has to be used in the expression itself, it needs to be escaped by backslash.
 * Perl style (), {}, [], and <> matching delimiters may also be used.
 * @since 1.0.0
 *
 * @internal
 */
final class Regex {

    /**
     * ### Perform a regular expression match
     *
     * Searches subject for a match to the regular expression given in a pattern.
     * @since 1.0.0
     *
     * @param string $pattern <p>
     * The regular expression pattern.
     * </p>
     * @param string $string <p>
     * The string being evaluated.
     * </p>
     * @param int $offset [optional] <p>
     * Normally, the search starts from the beginning of the subject string.
     * The optional parameter offset can be used to specify the alternate place from which to start the search (in
     * bytes).
     * </p>
     * @param bool $all [optional] <p>
     * If true, search subject for a match to the regular expression given in a pattern.
     * </p>
     * @param null|string[] &$result [optional] <p>
     * Regular expressions match the result.
     * </p>
     * @param-out array<string>|array<array<int, string>> $result
     *
     * @return bool True if the string matches the regular expression pattern, false if not.
     *
     * @warning This function may return Boolean false but may also return a non-Boolean value which evaluates to false.
     * Read the section on Booleans for more information.
     * Use the === operator for testing the return value of this function.
     */
    public static function match (string $pattern, string $string, int $offset = 0, bool $all = false, ?array &$result = null):bool {

        return $all
            ? preg_match_all($pattern, $string, $result, offset: $offset) !== 0
            : preg_match($pattern, $string, $result, offset: $offset) !== 0;

    }

    /**
     * ### Perform a regular expression search and replace
     *
     * Searches $subject for matches to $pattern and replaces them with $replacement.
     * @since 1.0.0
     *
     * @param string $pattern <p>
     * The regular expression pattern.
     * </p>
     * @param string $replacement <p>
     * The string to replace.
     * </p>
     * @param string $string <p>
     * The string being evaluated.
     * </p>
     * @param int $limit [optional] <p>
     * The maximum possible replacements for each pattern in each subject string.
     * Defaults to -1 (no limit).
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Regex\ReplaceException If error while performing a regular expression,
     * search and replace.
     *
     * @return string Replaced string.
     */
    public static function replace (string $pattern, string $replacement, string $string, int $limit = -1):string {

        return preg_replace($pattern, $replacement, $string, $limit)
            ?? throw new ReplaceException()
                ->withPattern($pattern)
                ->withReplacement($replacement)
                ->withString($string)
                ->withLimit($limit);

    }

    /**
     * ### Perform a regular expression search and replace using a callback
     *
     * Searches $subject for matches to $pattern and replaces them with $replacement.
     * @since 1.0.0
     *
     * @param string $pattern <p>
     * The regular expression pattern.
     * </p>
     * @param callable(array<array-key, string> $matches):string $callback <p>
     * A callback that will be called and passed an array of matched elements in the subject string.
     * The callback should return the replacement string.
     * This is the callback signature.
     * </p>
     * @param string $string <p>
     * The string being evaluated.
     * </p>
     * @param int $limit [optional] <p>
     * The maximum possible replacements for each pattern in each subject string.
     * Defaults to -1 (no limit).
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Regex\ReplaceException If error while performing a regular expression,
     * search and replace.
     *
     * @return string Replaced string.
     */
    public static function replaceFunc (string $pattern, callable $callback, string $string, int $limit = -1):string {

        return preg_replace_callback($pattern, $callback, $string, $limit)
            ?? throw new ReplaceException()
                ->withPattern($pattern)
                ->withReplacement('callable')
                ->withString($string)
                ->withLimit($limit);

    }

    /**
     * ### Split string by a regular expression
     *
     * Split the given string by a regular expression.
     * @since 1.0.0
     *
     * @param string $pattern <p>
     * The regular expression pattern.
     * </p>
     * @param string $string <p>
     * The input string.
     * </p>
     * @param int $limit [optional] <p>
     * The maximum possible replacements for each pattern in each subject string.
     * Defaults to -1 (no limit).
     * </p>
     * @param bool $remove_empty [optional] <p>
     * If true, only non-empty pieces will be returned.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Regex\SplitException If error while performing a regular expression
     * split.
     *
     * @return string[] Array containing substrings of $string split along boundaries matched by $pattern.
     */
    public static function split (string $pattern, string $string, int $limit = -1, bool $remove_empty = false):array {

        return preg_split($pattern, $string, $limit, $remove_empty ? PREG_SPLIT_NO_EMPTY : 0)
            ?: throw new SplitException()
                ->withPattern($pattern)
                ->withString($string)
                ->withLimit($limit)
                ->withRemoveEmpty($remove_empty);

    }

    /**
     * ### Quote regular expression characters
     *
     * Method takes string and puts a backslash in front of every character that is part of the regular expression syntax.
     * This is useful if you have a runtime string that you need to match in some text and the string may contain
     * special regex characters.
     * @since 1.0.0
     *
     * @param string $string <p>
     * The input string.
     * </p>
     * @param null|string $delimiter [optional] <p>
     * If the optional delimiter is specified, it will also be escaped.
     * This is useful for escaping the delimiter required by the PCRE functions.
     * The / is the most commonly used delimiter.
     * </p>
     *
     * @return string The quoted (escaped) string.
     */
    public static function quote (string $string, ?string $delimiter = null):string {

        return preg_quote($string, $delimiter);

    }

}
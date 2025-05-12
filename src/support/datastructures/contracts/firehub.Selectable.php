<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2024 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Support
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Support\DataStructures\Contracts;

/**
 * ### Data structure from which items can be selected based on some rules
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
interface Selectable {

    /**
     * ### Get slice from data structure
     * @since 1.0.0
     *
     * @param int $offset <p>
     * If the offset is non-negative, the sequence will start at that offset of the data structure.
     * If the offset is negative, the sequence will start that far from the end of the data structure.
     * </p>
     * @param null|int $length [optional] <p>
     * If length is given and is positive, then the sequence will have that many elements in it.
     * If length is given and is negative, then the sequence will stop that many elements from the end of the
     * data structure.
     * If it is omitted, then the sequence will have everything from offset up until the end of the data structure.
     * </p>
     *
     * @return static<TKey, TValue> New sliced data structure.
     */
    public function slice (int $offset, ?int $length = null):static;

    /**
     * ### Take first n items from data structure
     * @since 1.0.0
     *
     * @param int $count <p>
     * If the count is positive, then the sequence will have that many elements in it.
     * If the count is negative, then the sequence will stop that many elements from the end of the data structure.
     * </p>
     *
     * @return self<TKey, TValue> New filtered data structure.
     */
    public function take (int $count):self;

    /**
     * ### Take until the given callback returns true
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return self<TKey, TValue> New data structure with items.
     */
    public function takeUntil (callable $callback):self;

    /**
     * ### Take while the given callback returns true
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return self<TKey, TValue> New data structure with items.
     */
    public function takeWhile (callable $callback):self;

    /**
     * ### Skip first n items from data structure
     * @since 1.0.0
     *
     * @param int $count <p>
     * If the count is non-negative, the sequence will start at that offset of the data structure.
     * If the count is negative, the sequence will start that far from the end of the data structure.
     * </p>
     *
     * @return self<TKey, TValue> New data structure with items.
     */
    public function skip (int $count):self;

    /**
     * ### Skip until the given callback returns true
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return self<TKey, TValue> New data structure with items.
     */
    public function skipUntil (callable $callback):self;

    /**
     * ### Skip while the given callback returns true
     * @since 1.0.0
     *
     * @param callable(TValue, TKey=):bool $callback <p>
     * Function to call on each item in a data structure.
     * </p>
     *
     * @return self<TKey, TValue> New data structure with items.
     */
    public function skipWhile (callable $callback):self;

    /**
     * ### Data structure consisting of every n-th element
     * @since 1.0.0
     *
     * @param positive-int $step <p>
     * N-th step.
     * </p>
     * @param int $offset [optional] <p>
     * If the offset is non-negative, the sequence will start at that offset of the data structure.
     * If the offset is negative, the sequence will start that far from the end of the data structure.
     * </p>
     * @param null|int $length [optional] <p>
     * If length is given and is positive, then the sequence will have that many elements in it.
     * If length is given and is negative, then the sequence will stop that many elements from the end of the
     * data structure.
     * If it is omitted, then the sequence will have everything from offset up until the end of the data structure.
     * </p>
     *
     * @return static<TKey, TValue> New filtered data structure.
     */
    public function nth (int $step, int $offset = 0, ?int $length = null):static;

    /**
     * ### New data structure consisting of even elements
     * @since 1.0.0
     *
     * @return self<TKey, TValue> New filtered data structure.
     */
    public function even ():self;

    /**
     * ### New data structure consisting of odd elements
     * @since 1.0.0
     *
     * @return self<TKey, TValue> New filtered data structure.
     */
    public function odd ():self;

}
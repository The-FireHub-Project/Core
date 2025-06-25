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

namespace FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection;

use FireHub\Core\Support\DataStructures\Operation\Select;
use FireHub\Core\Support\DataStructures\Helpers\Where;
use FireHub\Core\Support\Enums\Comparison;
use FireHub\Core\Support\LowLevel\Arr;

use function FireHub\Core\Support\Helpers\Arr\uniqueDuplicatesTwoDimensional;

/**
 * ### Matrix array collection type
 *
 * Two-dimensional array arranged in rows and columns.
 * It is commonly used to represent mathematical matrices and is fundamental in various fields like mathematics,
 * computer graphics, and data processing.
 * @since 1.0.0
 *
 * @template TIdentify of array-key
 * @template TColumns of array<array-key, mixed>
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<TIdentify, TColumns>
 *
 * @api
 */
class Matrix extends Associative {

    /**
     * ### Takes unique values from a matrix data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\uniqueDuplicatesTwoDimensional() As unique function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
     *
     * $collection = new Matrix([
     *  1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
     *  2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
     *  3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
     *  4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
     *  5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
     * ]);
     *
     * $unique = $collection->unique();
     *
     * // [
     * //   1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
     * //   3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25]
     * // ]
     * ```
     *
     * @param key-of<TColumns> $column <p>
     * Array key to group with.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\ArrayItemMissingKeyException If any of the items doesn't have
     * a provided key.
     *
     * @return static<TIdentify, TColumns> New filtered matrix data structure.
     */
    public function unique (mixed $column):static {

        return new static(uniqueDuplicatesTwoDimensional($this->storage, $column)['unique']);

    }

    /**
     * ### Takes duplicates values from a matrix data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\uniqueDuplicatesTwoDimensional() As unique function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
     *
     * $collection = new Matrix([
     *  1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
     *  2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
     *  3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
     *  4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
     *  5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
     * ]);
     *
     * $duplicates = $collection->duplicates();
     *
     * // [
     * //   2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
     * //   4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
     * //   5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
     * // ]
     * ```
     *
     * @param key-of<TColumns> $column <p>
     * Array key to group with.
     * </p>
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\ArrayItemMissingKeyException If any of the items doesn't have
     * a provided key.
     *
     * @return static<TIdentify, TColumns> New filtered matrix data structure.
     */
    public function duplicates (mixed $column):static {

        return new static(uniqueDuplicatesTwoDimensional($this->storage, $column)['duplicates']);

    }

    /**
     * ### Filter matrix items
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select As return.
     * @uses \FireHub\Core\Support\DataStructures\Helpers\Where::and() As and filter.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
     * use FireHub\Core\Support\Enums\Comparison;
     *
     * $collection = new Matrix([
     *  1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
     *  2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
     *  3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
     *  4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
     *  5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
     * ]);
     *
     * $select = $collection->select('id', Comparison::GREATER, 2, ['lastname', Comparison::EQUAL, 'Doe'])
     *  ->or('firstname', Comparison::EQUAL, 'Richard');
     *
     * // [
     * //   3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
     * //   4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
     * //   5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
     * // ]
     * ```
     *
     * @param key-of<TColumns> $compare <p>
     * Matrix key to compare.
     * </p>
     * @param \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison> $comparison <p>
     * Comparison operator.
     * </p>
     * @param value-of<TColumns> $with <p>
     * Value to compare with.
     * </p>
     * @param array<array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>}> ...$and <p>
     * And filter.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Operation\Select<$this, TColumns> New matrix with selected items.
     */
    public function select (mixed $compare, Comparison|string $comparison, mixed $with, array ...$and):Select {

        $where = new Where($this, $compare, $comparison, $with);

        foreach ($and as $value)
            $where->and(...$value); // @phpstan-ignore argument.type

        return new Select($this, $where); // @phpstan-ignore return.type

    }

    /**
     * ### Return the values from a single column in the matrix data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed As return,
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative As return.
     * @uses \FireHub\Core\Support\LowLevel\Arr::column() To get values from a single column of the matrix.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
     * use FireHub\Core\Support\Enums\Comparison;
     *
     * $collection = new Matrix([
     *  1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
     *  2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
     *  3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
     *  4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
     *  5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
     * ]);
     *
     * $column = $collection->column('lastname');
     *
     * // Indexed['Doe', 'Doe', 'Roe', 'Doe', 'Doe']
     * ```
     * @example With the provided index.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
     * use FireHub\Core\Support\Enums\Comparison;
     *
     * $collection = new Matrix([
     *  1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
     *  2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
     *  3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
     *  4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
     *  5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
     * ]);
     *
     * $column = $collection->column('lastname', 'firstname');
     *
     * // Associative[
     * //   'John' => 'Doe',
     * //   'Jane' => 'Doe',
     * //   'Richard' => 'Roe',
     * //   'Johnie' => 'Doe',
     * //   'Janie' => 'Doe'
     * ]
     * ```
     *
     * @param key-of<TColumns> $column <p>
     * The column of values to return.
     * This value may be an integer key of the column you wish to retrieve, or it may be a string key name for an
     * associative array or property name.
     * It may also be null to return complete arrays or objects (this is useful together with $index to reindex the
     * array).
     * </p>
     * @param null|key-of<TColumns> $index [optional] <p>
     * The column to use as the index/keys for the returned array.
     * This value may be the integer key of the column, or it may be the string key name.
     * The value is cast as usual for array keys.
     * </p>
     *
     * @return ($index is null ? \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed<value-of<TColumns>> : \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<value-of<TColumns>, value-of<TColumns>>)
     * Data structure representing a single column from the matrix values.
     *
     * @phpstan-ignore-next-line parameter.phpDocType, generics.notSubtype
     */
    public function column (int|string $column, null|int|string $index = null):Indexed|Associative {

        // @phpstan-ignore return.type
        return $index ? new Associative(Arr::column($this->storage, $column, $index))
            : new Indexed(Arr::column($this->storage, $column));

    }

    /**
     * ### Collapses a matrix into a single, flat data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed As return.
     * @uses \FireHub\Core\Support\LowLevel\Arr::merge() To merge empty array and matrix items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
     * use FireHub\Core\Support\Enums\Comparison;
     *
     * $collection = new Matrix([
     *  [1, 2, 3],
     *  [4, 5, 6],
     *  [7, 8, 9]
     * ]);
     *
     * $collapse = $collection->collapse();
     *
     * // Indexed[1, 2, 3, 4, 5, 6, 7, 8, 9]
     * ```
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed<value-of<TColumns>>
     */
    public function collapse ():Indexed {

        return new Indexed(Arr::merge([], ...$this->storage));

    }

}
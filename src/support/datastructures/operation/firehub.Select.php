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

namespace FireHub\Core\Support\DataStructures\Operation;

use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
use FireHub\Core\Support\DataStructures\Helpers\Where;
use FireHub\Core\Support\Enums\Comparison;
use FireHub\Core\Support\LowLevel\Arr;

/**
 * ### Filter matrix items
 * @since 1.0.0
 *
 * @template TMatrix of \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix
 * @template TColumns of array<array-key, mixed>
 */
class Select {

    /**
     * ### Select filter result
     * @since 1.0.0
     *
     * @var TMatrix
     */
    protected Matrix $result;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix As parameter.
     * @uses \FireHub\Core\Support\DataStructures\Helpers\Where As parameter.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select::filter() To filter result.
     *
     * @param TMatrix $matrix <p>
     * Instance of matrix.
     * </p>
     * @param \FireHub\Core\Support\DataStructures\Helpers\Where<value-of<TMatrix>> $where <p>
     * Filter matrix items based on key-value comparison.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Matrix $matrix,
        protected Where $where
    ) {

        $this->result = $this->filter($this->where);

    }

    /**
     * ### And filter
     * @since 1.0.0
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
     * @return $this
     */
    public function or (mixed $compare, Comparison|string $comparison, mixed $with, array ...$and):self {

        $where = new Where($this->matrix, $compare, $comparison, $with);

        foreach ($and as $value)
            $where->and(...$value); // @phpstan-ignore argument.type

        $or = $this->filter($where);

        $this->result = $this->result->union($or); // @phpstan-ignore assign.propertyType

        return $this;

    }

    /**
     * ### Get select filter result
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix As return.
     *
     * @return TMatrix Select filter result.
     */
    public function result ():Matrix {

        return $this->result;

    }

    /**
     * ### Filter result
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Helpers\Where As parameter.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix::filter() To filter matrix items.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select::compare() To compare values.
     * @uses \FireHub\Core\Support\LowLevel\Arr::all() To check if all array elements satisfy a callback function.
     *
     * @param \FireHub\Core\Support\DataStructures\Helpers\Where<value-of<TMatrix>> $where <p>
     * Filter matrix items based on key-value comparison.
     * </p>
     *
     * @return TMatrix Filtered result.
     */
    protected function filter (Where $where):Matrix {

        // @phpstan-ignore return.type
        return $this->matrix->filter(function ($row) use ($where) {

            if (
                $this->compare(
                    $where->comparison,
                    $row[$where->compare],
                    $where->with
                ) === false
            ) return false;

            return Arr::all($where->and, fn($and) => $this->compare(
                    $and[1],
                    $row[$and[0]],
                    $and[2]
                ) !== false);

        });

    }

    /**
     * ### Compare values
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Enums\Comparison::compare() To compare the current enum with provided values.
     *
     * @param \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison> $comparison <p>
     * Value A to compare.
     * </p>
     * @param mixed $value <p>
     * Value A to compare.
     * </p>
     * @param mixed $with <p>
     * Value B to with value A.
     * </p>
     *
     * @return bool|int Comparison result: true, false, -1, 0, or 1 if SPACESHIP is used.
     */
    protected function compare (string|Comparison $comparison, mixed $value, mixed $with):bool|int {

        return $comparison instanceof Comparison
            ? $comparison->compare($value, $with)
            : Comparison::from($comparison)->compare($value, $with);

    }

}
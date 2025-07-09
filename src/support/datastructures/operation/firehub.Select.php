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
use FireHub\Core\Support\Enums\Comparison;

/**
 * ### Filter matrix items
 * @since 1.0.0
 *
 * @template TMatrix of \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix<TIdentify, TColumns>
 * @template TIdentify of array-key
 * @template TColumns of array<array-key, mixed>
 */
class Select {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix As parameter.
     *
     * @param TMatrix $matrix <p>
     * Instance of matrix.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Matrix $matrix
    ) {}

    /**
     * ### Filters the matrix by a given key / value pair
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select::filter() To filter the matrix.
     *
     * @param array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>} $rule <p>
     * Matrix filter.
     * </p>
     * @param array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>} ...$or <p>
     * And filters.
     * </p>
     *
     * @return $this
     */
    public function where (array $rule, array ...$or):self {

        $this->matrix = $this->filter($rule, ...$or);

        return $this;

    }

    /**
     * ### Filters the matrix against a given key / value pair
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select::filter() To filter the matrix.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix::difference() To remove filtered
     * items.
     *
     * @param array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>} $rule <p>
     * Matrix filter.
     * </p>
     * @param array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>} ...$or <p>
     * And filters.
     * </p>
     *
     * @return $this
     */
    public function whereNot (array $rule, array ...$or):self {

        $this->matrix = $this->matrix->difference( // @phpstan-ignore assign.propertyType
            $this->filter($rule, ...$or), // @phpstan-ignore argument.type
            fn($value_a, $value_b) => $value_a <=> $value_b);

        return $this;

    }

    /**
     * ### Filters the matrix where value is between
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select::where To filter the matrix by a given key / value
     * pair.
     * @uses \FireHub\Core\Support\Enums\Comparison::GREATER_OR_EQUAL As comparison enum.
     * @uses \FireHub\Core\Support\Enums\Comparison::LESS_OR_EQUAL As comparison enum.
     *
     * @param key-of<TColumns> $column <p>
     * Column to filter.
     * </p>
     * @param value-of<TColumns> $start <p>
     * The start value.
     * </p>
     * @param value-of<TColumns> $end <p>
     * The end value.
     * </p>
     *
     * @return $this
     */
    public function whereBetween (mixed $column, mixed $start, mixed $end):static {

        return $this
            ->where([$column, Comparison::GREATER_OR_EQUAL, $start])
            ->where([$column, Comparison::LESS_OR_EQUAL, $end]);

    }

    /**
     * ### Filters the matrix where value is not between
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select::where To filter the matrix by a given key / value
     * pair.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix::union() To create a new matrix
     * with values appearing in filtered matrix.
     * @uses \FireHub\Core\Support\Enums\Comparison::LESS As comparison enum.
     * @uses \FireHub\Core\Support\Enums\Comparison::GREATER As comparison enum.
     *
     * @param key-of<TColumns> $column <p>
     * Column to filter.
     * </p>
     * @param value-of<TColumns> $start <p>
     * The start value.
     * </p>
     * @param value-of<TColumns> $end <p>
     * The end value.
     * </p>
     *
     * @return $this
     */
    public function whereNotBetween (mixed $column, mixed $start, mixed $end):static {

        $this->matrix = (clone $this)->where([$column, Comparison::LESS, $start]) // @phpstan-ignore assign.propertyType
            ->matrix->union((clone $this)->where([$column, Comparison::GREATER, $end])->matrix);

        return $this;

    }

    /**
     * ### Get filtered Matrix
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix As return.
     *
     * @return TMatrix Filtered Matrix result.
     */
    public function result ():Matrix {

        return $this->matrix;

    }

    /**
     * ### Filters the matrix
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix As return.
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select::compare() To compare values.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix::filter() To filter matrix results.
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix::union() To create a new matrix
     * with values appearing in filtered matrix.
     *
     * @param array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>} $rule <p>
     * Matrix filter.
     * </p>
     * @param array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>} ...$or <p>
     * And filters.
     * </p>
     *
     * @return TMatrix Filtered Matrix result.
     */
    protected function filter (array $rule, array ...$or):Matrix {

        $matrix = $this->matrix->filter(fn($row) => $this->compare( // @phpstan-ignore argument.type
            $rule[1],
            $row[$rule[0]],
            $rule[2]
        ));

        foreach ($or as $or_rule)
            $matrix = $matrix->union($this->matrix->filter(fn($row) => $this->compare( // @phpstan-ignore argument.type
                $or_rule[1],
                $row[$or_rule[0]],
                $or_rule[2]
            )));

        return $matrix; // @phpstan-ignore return.type

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
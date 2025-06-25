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

namespace FireHub\Core\Support\DataStructures\Function;

use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
use FireHub\Core\Support\LowLevel\ {
    Arr, DataIs, Iterables
};

/**
 * ### Group matrix data structure based on keys
 * @since 1.0.0
 *
 * @template TMatrix of \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix<array-key, TColumns>
 * @template TColumns of array<array-key, mixed>
 */
readonly class GroupBy {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix As parameter.
     *
     * @param TMatrix $data_structure <p>
     * Instance of data structures.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Matrix $data_structure
    ) {}

    /**
     * ### Merge data
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\DataIs::callable() To check if the provided column is callable.
     * @uses \FireHub\Core\Support\LowLevel\Arr::merge() To merge data.
     * @uses \FireHub\Core\Support\LowLevel\Arr::slice() To extract a slice of the array.
     * @uses \FireHub\Core\Support\LowLevel\Iterables::count() To count the number of columns.
     *
     * @param array<key-of<TColumns>, array<array-key, mixed>> $array <p>
     * The array.
     * </p>
     * @param key-of<TColumns>|callable(TColumns):mixed $column <p>
     * Columns to group by.
     * </p>
     *
     * @return array<value-of<TColumns>, array<array-key, mixed>>
     *
     * @phpstan-ignore parameter.phpDocType
     */
    private function merge (array $array, int|string|callable $column, int|string|callable ...$columns):array {

        $_key = $column;

        $merge = [];
        foreach ($array as $array_key => $value) {

            if (DataIs::callable($_key))
                $column = $_key($value);
            else if (isset($value[$_key]))
                $column = $value[$_key];

            if ($column === null) continue;

            $merge[$column][$array_key] = $value;

        }

        if (!empty($columns)) {

            foreach ($merge as $key => $value) {

                $params = Arr::merge([$value], Arr::slice($columns, 0, Iterables::count($columns) +2 ));

                $merge[$key] = $this->merge(...$params); // @phpstan-ignore argument.type

            }

        }

        return $merge;

    }

    /**
     * ### Call an object as a function
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix As return.
     * @uses \FireHub\Core\Support\DataStructures\Function\GroupBy::merge()  To merge data.
     *
     * @param key-of<TColumns>|callable(TColumns):mixed ...$columns <p>
     * Columns to group by.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix<array-key, array<array-key, mixed>>
     * New matrix with grouped data.
     */
    public function __invoke (mixed ...$columns):Matrix {

        return new Matrix($this->merge($this->data_structure->toArray(), ...$columns));

    }

}
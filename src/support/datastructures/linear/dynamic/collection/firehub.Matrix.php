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
     * ### Filter matrix items
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\Select As return.
     * @uses \FireHub\Core\Support\DataStructures\Helpers\Where::and() As and filter.
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

}
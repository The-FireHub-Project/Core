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

namespace FireHub\Core\Support\DataStructures\Helpers;

use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix;
use FireHub\Core\Support\Enums\Comparison;

/**
 * ### Matrix array key-value comparison
 * @since 1.0.0
 *
 * @template TColumns of array<array-key, mixed>
 */
final class Where {

    /**
     * ### And filter
     * @since 1.0.0
     *
     * @var array<array{key-of<TColumns>, \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison>, value-of<TColumns>}>
     */
    public array $and = [];

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Matrix<array-key, TColumns> $matrix <p>
     * Instance of matrix.
     * </p>
     * @param key-of<TColumns> $compare <p>
     * Matrix key to compare.
     * </p>
     * @param \FireHub\Core\Support\Enums\Comparison|value-of<\FireHub\Core\Support\Enums\Comparison> $comparison <p>
     * Comparison operator.
     * </p>
     * @param value-of<TColumns> $with <p>
     * Value to compare with.
     * </p>
     *
     * @return void
     */
    public function __construct (
        readonly protected Matrix $matrix,
        readonly public mixed $compare,
        readonly public Comparison|string $comparison,
        readonly public mixed $with
    ) {}

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
     *
     * @return $this
     */
    public function and (mixed $compare, Comparison|string $comparison, mixed $with):self {

        $this->and[] = [$compare, $comparison, $with];

        return $this;

    }

}
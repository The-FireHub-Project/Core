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

namespace FireHub\Core\Support\DataStructures\Linear;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed as FixedContract;
use FireHub\Core\Support\DataStructures\Traits\Common;
use SplFixedArray;

/**
 * ### Fixed data structure type
 *
 * Fixed data structure allows only integers as keys, but it is faster and uses less memory than an array collection.
 * This collection type must be resized manually and allows only integers within the range as indexes.
 * @since 1.0.0
 *
 * @template TValue
 *
 * @extends SplFixedArray<TValue>
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed<int, ?TValue>
 *
 * @phpstan-consistent-constructor
 *
 * @api
 */
class Fixed extends SplFixedArray implements FixedContract {

    /**
     * ### Common data structure methods
     * @since 1.0.0
     *
     * @use \FireHub\Core\Support\DataStructures\Traits\Common<int, ?TValue>
     */
    use Common;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param non-negative-int $size <p>
     * Size of the data structure.
     * </p>
     *
     * @return void
     */
    public function __construct (int $size) {

        parent::__construct($size);

    }

}
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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;

/**
 * ### Data structure that is capable of being chunked into smaller pieces
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue>
 */
interface Chunkable extends DataStructures {

    /**
     * ### Split data structure into chunks by user function
     * @since 1.0.0
     *
     * @param callable(TValue, TKey):bool $callback <p>
     * Function to chunk by.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy<int, static<TKey, TValue>>
     * New chunked data structure.
     */
    public function chunkWhere (callable $callback):Lazy;

}
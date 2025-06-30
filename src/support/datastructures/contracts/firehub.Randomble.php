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

/**
 * ### Select random value from data structure
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue>
 */
interface Randomble extends DataStructures {

    /**
     * ### Select random value from data structure
     * @since 1.0.0
     *
     * @param positive-int $number [optional] <p>
     * Specifies how many entries you want to pick from a collection.
     * </p>
     *
     * @return TValue|static<TKey, TValue> Random value from data structure.
     */
    public function random (int $number = 1):mixed;

}
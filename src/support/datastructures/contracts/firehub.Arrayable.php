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
 * ### Arrayable data structure has their instance created with an array
 * @since 1.0.0
 *
 * @template TKey of array-key
 * @template TValue
 */
interface Arrayable {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param null|array<TKey, TValue> $storage [optional] <p>
     * Array to create underlying storage data.
     * </p>
     *
     * @return void
     */
    public function __construct (?array $storage = null);

}
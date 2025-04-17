<?php declare(strict_types = 1);

/**
 * This file is part of FireHub Web Application Framework package
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

use FireHub\Core\Support\Contracts\Magic\Overloadable as MagicOverloadable;

/**
 * ### Overloadable data structure contract
 * @since 1.0.0
 *
 * @template TKey of array-key
 * @template TValue
 */
interface Overloadable extends MagicOverloadable {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param TKey $name <p>
     * Property name.
     * </p>
     */
    public function __get (int|string $name):mixed;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param TKey $name <p>
     * Property name.
     * </p>
     * @param TValue $value <p>
     * Property value.
     * </p>
     */
    public function __set (int|string $name, mixed $value):void;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param TKey $name <p>
     * Property name.
     * </p>
     */
    public function __isset (int|string $name):bool;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @param TKey $name <p>
     * Property name.
     * </p>
     */
    public function __unset (int|string $name):void;

}
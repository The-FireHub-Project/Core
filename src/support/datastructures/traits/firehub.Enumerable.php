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

namespace FireHub\Core\Support\DataStructures\Traits;

use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, Find
};

/**
 * ### Enumerable data structure methods that every element meets a given criterion
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 */
trait Enumerable {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function countBy ():CountBy {

        return new CountBy($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function find ():Find {

        return new Find($this);

    }

}
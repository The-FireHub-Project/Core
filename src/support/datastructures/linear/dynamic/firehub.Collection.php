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

namespace FireHub\Core\Support\DataStructures\Linear\Dynamic;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic;
use FireHub\Core\Support\Contracts\ArrayAccessible;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, When
};

/**
 * ### Abstract collection type
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic<TKey, TValue>
 * @implements \FireHub\Core\Support\Contracts\ArrayAccessible<TKey, TValue>
 */
abstract class Collection implements Dynamic, ArrayAccessible {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection::countBy() To count elements in
     * a data structure.
     */
    public function count ():int {

        return $this->countBy()->elements();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\CountBy As return.
     */
    public function countBy ():CountBy {

        return new CountBy($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Operation\When<static> As return.
     */
    public function when ():When {

        return new When($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection::toArray() To get data structure an array.
     */
    public function jsonSerialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection::toArray() To get data structure an array.
     */
    public function __serialize ():array {

        return $this->toArray();

    }

}
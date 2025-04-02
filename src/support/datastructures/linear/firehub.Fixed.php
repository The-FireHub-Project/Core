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
use FireHub\Core\Support\Contracts\ArrayAccessible;
use FireHub\Core\Support\DataStructures\Operation\CountBy;
use SplFixedArray, Traversable;

/**
 * ### Fixed data structure type
 *
 * Fixed data structure allows only integers as keys, but it is faster and uses less memory than an array collection.
 * This collection type must be resized manually and allows only integers within the range as indexes.
 * @since 1.0.0
 *
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Fixed<int, ?TValue>
 * @implements \FireHub\Core\Support\Contracts\ArrayAccessible<int, ?TValue>
 *
 * @api
 */
class Fixed implements FixedContract, ArrayAccessible {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var SplFixedArray<TValue>
     */
    protected SplFixedArray $storage;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param positive-int $size <p>
     * Size of the data structure.
     * </p>
     *
     * @return void
     */
    public function __construct (int $size) {

        $this->storage = new SplFixedArray($size);

    }

    /**
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
     */
    public function offsetExists (mixed $offset):bool {

        return isset($this->storage[$offset]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetGet (mixed $offset):mixed {

        return $this->storage[$offset];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetSet (mixed $offset, mixed $value):void {

        $this->storage[$offset] = $value;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function offsetUnset (mixed $offset):void {

        unset($this->storage[$offset]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function getIterator ():Traversable {

        yield from $this->storage;

    }

}
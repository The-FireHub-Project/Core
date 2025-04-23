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

namespace FireHub\Core\Support\DataStructures;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, Ensure, When
};
use FireHub\Core\Support\Traits\ {
    Jsonable, Serializable
};

use const FireHub\Core\Support\Constants\Number\MAX;

/**
 * ### Abstract collection type
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @implements \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue>
 */
abstract class DataStructure implements DataStructures {

    /**
     * ### Trait contains all common JSON methods
     * @since 1.0.0
     */
    use Jsonable;

    /**
     * ### Trait contains all common serialize and unserialize methods
     * @since 1.0.0
     */
    use Serializable;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    abstract public function toArray ():array;

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
     * @uses \FireHub\Core\Support\DataStructures\Operation\Ensure As return.
     */
    public function ensure ():Ensure {

        return new Ensure($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\DataStructure::count() To count data structure items.
     */
    public function isEmpty ():bool {

        return $this->count() === 0;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\DataStructure::isEmpty() To check if the data structure is empty.
     */
    public function isNotEmpty ():bool {

        return !$this->isEmpty();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Number\MAX As default limit.
     */
    public function each (callable $callback, int $limit = MAX):static {

        $counter = 1;

        foreach ($this as $key => $value) {
            if ($counter++ > $limit) break;
            $callback($value, $key);
        }

        return $this;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Number\MAX As default limit.
     */
    public function all (callable $callback, int $limit = MAX):bool {

        $counter = 1;

        foreach ($this as $key => $value) {
            if ($counter++ > $limit) break;
            else if ($callback($value, $key) === false) return false;
        }

        return true;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Number\MAX As default limit.
     */
    public function any (callable $callback, int $limit = MAX):bool {

        $counter = 1;

        foreach ($this as $key => $value) {
            if ($counter++ > $limit) break;
            else if ($callback($value, $key)) return true;
        }

        return false;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Constants\Number\MAX As default limit.
     */
    public function none (callable $callback, int $limit = MAX):bool {

        $counter = 1;

        foreach ($this as $key => $value) {
            if ($counter++ > $limit) break;
            else if ($callback($value, $key) === true) return false;
        }

        return true;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\DataStructure::toArray() To get data structure an array.
     */
    public function jsonSerialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\DataStructure::toArray() To get data structure an array.
     */
    public function __serialize ():array {

        return $this->toArray();

    }

    /**
     * @inheritDoC
     *
     * @since 1.0.0
     */
    abstract protected static function jsonToObject (array $data):static;

}
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

use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, Contains, Ensure, Find, Is
};
use FireHub\Core\Support\LowLevel\DataIs;

use const FireHub\Core\Support\Constants\Number\MAX;

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
    public function contains ():Contains {

        return new Contains($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function ensure ():Ensure {

        return new Ensure($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function find ():Find {

        return new Find($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function is ():Is {

        return new Is($this);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->each(fn($value, $key) => $this->collection[$key] = $value.'.', 2);
     *
     * // ['firstname' => 'John.', 'lastname' => 'Doe.', 'age' => 25, 10 => 2]
     * ```
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
     * ### Get keys from the data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed As return.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::null To check if the $with_value parameter is passed.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->keys();
     *
     * // ['firstname', 'lastname', 'age', 10]
     * ```
     * @example With value filter.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->keys('John');
     *
     * // ['firstname']
     * ```
     *
     * @param mixed $with_value [optional] <p>
     * If specified, then only keys containing these values are returned.
     * </p>
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed<TKey> Keys from the data
     * structure.
     */
    public function keys (mixed $with_value = null):Indexed {

        $array = [];

        if (DataIs::null($with_value))
            foreach ($this as $key => $value) $array[] = $key;

        else foreach ($this as $key => $value)
            if ($value === $with_value) $array[] = $key;

        return new Indexed($array);

    }

    /**
     * ### Get values from the data structure
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed As return.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $collection->values();
     *
     * // ['John', 'Doe', 25, 2]
     * ```
     *
     * @return \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed<TValue> Values from the data
     * structure.
     */
    public function values ():Indexed {

        $array = [];

        foreach ($this as $value)
            $array[] = $value;

        return new Indexed($array);

    }

}
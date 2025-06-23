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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\ {
    Lazy, Collection\Indexed, Collection\Associative
};
use FireHub\Core\Support\DataStructures\Operation\ {
    CountBy, Contains, Ensure, Find, Is
};
use FireHub\Core\Support\DataStructures\Function\ {
    Combine, Keys, Values
};
use FireHub\Core\Support\LowLevel\Iterator;

use const FireHub\Core\Support\Constants\Number\MAX;

use function FireHub\Core\Support\Helpers\PHP\sleep;

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
     * @uses \FireHub\Core\Support\LowLevel\Iterator::count() To count storage items.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $count = $collection->count();
     *
     * // 6
     */
    public function count ():int {

        return Iterator::count($this);

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
     * $collection->each(fn($value, $key) => $collection->set($value.'.', $key), 2);
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
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::transform() To apply the callback to the elements
     * of the data structure.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative;
     *
     * $collection = new Associative(['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25, 10 => 2]);
     *
     * $with_dots = $collection->apply(fn($value) => $value.'.');
     *
     * // ['firstname' => 'John.', 'lastname' => 'Doe.', 'age' => '25.', 10 => '2.']
     * ```
     */
    public function apply (callable $callback):static {

        return (clone $this)->transform($callback); // @phpstan-ignore return.type

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->when(
     *     true,
     *     fn(Indexed $collection) => $collection->append('Johnie'),
     *     fn(Indexed $collection) => $collection->append('Janie)
     * );
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie']
     * ```
     */
    public function when (bool $condition, callable $condition_meet, ?callable $condition_not_meet = null):static {

        if ($condition)
            $condition_meet($this);
        else if ($condition_not_meet !== null)
            $condition_not_meet($this);

        return $this;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->unless(
     *     true,
     *     fn(Indexed $collection) => $collection->append('Johnie'),
     *     fn(Indexed $collection) => $collection->append('Janie)
     * );
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Janie']
     * ```
     */
    public function unless (bool $condition, callable $condition_meet, ?callable $condition_not_meet = null):static {

        if (!$condition)
            $condition_meet($this);
        else if ($condition_not_meet !== null)
            $condition_not_meet($this);

        return $this;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Function\Keys As a function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $keys = $collection->keys();
     *
     * // [0, 1, 2]
     * ```
     * @example With user-defined filter.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $keys = $collection->keys(fn($value, $key) => $value === 'two');
     *
     * // [0, 2]
     * ```
     */
    public function keys (?callable $callback = null):Indexed {

        return new Keys($this)($callback);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Function\Values As a function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $keys = $collection->values();
     *
     * // ['one', 'two', 'three']
     * ```
     * @example With user-defined filter.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Fixed;
     *
     * $collection = new Fixed(3);
     *
     * $collection[0] = 'one';
     * $collection[1] = 'two';
     * $collection[2] = 'three';
     *
     * $keys = $collection->values(fn($value, $key) => $key !== 1);
     *
     * // ['one', 'three']
     * ```
     */
    public function values (?callable $callback = null):Indexed {

        return new Values($this)($callback);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Function\Combine As a function.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Richard']);
     * $collection2 = new Indexed(['one', 'two', 'three']);
     *
     * $collection->combine($collection2);
     *
     * // ['John' => 'one', 'Jane' => 'two', 'Richard' => 'three']
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\KeysAndValuesDiffNumberOfElemsException If arguments $keys and
     * $values don't have the same number of elements.
     */
    public function combine (DataStructures $data_structure):Associative {

        return new Combine($this)($data_structure);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\PHP\sleep() As sleep function.
     */
    public function throttle (float $seconds_and_microseconds):Lazy {

        return new Lazy (function () use ($seconds_and_microseconds) {

            foreach ($this as $key => $value) {

                yield $key => $value;

                sleep($seconds_and_microseconds);

            }

        });

    }

}
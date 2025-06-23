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

namespace FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\DataStructures\Contracts\ {
    Arrayable, Sequantionable
};
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\LowLevel\Arr;

use function FireHub\Core\Support\Helpers\Arr\ {
    first, last, random
};

/**
 * ### Indexed array collection type
 *
 * Collections which have numerical indexes in an ordered sequential manner (starting from 0 and ending with n-1).
 * @since 1.0.0
 *
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ArrStorage<int, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Arrayable<int, TValue>
 * @implements \FireHub\Core\Support\DataStructures\Contracts\Sequantionable<TValue>
 */
class Indexed extends ArrStorage implements Arrayable, Sequantionable {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var array<TValue>
     *
     * @phpstan-ignore property.phpDocType
     */
    protected array $storage;

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::values() To help with removing keys from an array.
     *
     * @param null|array<TValue> $storage [optional] <p>
     * Array to create underlying storage data.
     * </p>
     *
     * @caution This collection will reindex the provided array if it is not already numerically indexed.
     */
    public function __construct (?array $storage = null) {

        $this->storage = $storage ? Arr::values($storage) : [];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public static function fromDataStructure (DataStructures $data_structure):static {

        $storage = [];

        foreach ($data_structure as $value)
            $storage[] = $value;

        return new static($storage);

    }

    /**
     * ### Create a data structure from an array
     * @since 1.0.0
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $array = ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard'];
     *
     * $collection = Indexed::fromArray($array);
     * ```
     *
     * @param array<array-key, TValue> $array <p>
     * Data for data structure.
     * </p>
     *
     * @return static<TValue> Data structure from an array.
     */
    public static function fromArray (array $array):static {

        return new static($array);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::shift() To remove an item at the beginning of the data structure if
     * $items value is 5 or less.
     * @uses \FireHub\Core\Support\LowLevel\Arr::splice() To remove an item at the beginning of the data structure if
     * $items value is more than 5.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->shift();
     *
     * // ['Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     * @example Removing more than one item.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->shift(3);
     *
     * // ['Jane', 'Richard', 'Richard']
     * ```
     */
    public function shift (int $items = 1):void {

        if ($items <= 5)
            for ($i = 0; $i < $items; $i++) Arr::shift($this->storage);

        else Arr::splice($this->storage, 0, $items);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::pop() To remove an item at the end of the data collection if
     * $items value is 5 or less.
     * @uses \FireHub\Core\Support\LowLevel\Arr::splice() To remove an item at the end of the data collection if
     * $items value is greater than 5.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->pop();
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard']
     * ```
     * @example Removing more than one item.
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $collection->pop(3);
     *
     * // ['John', 'Jane', 'Jane']
     * ```
     */
    public function pop (int $items = 1):void {

        if ($items <= 5)
            for ($i = 0; $i < $items; $i++) Arr::pop($this->storage);

        else Arr::splice($this->storage, -$items);

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
     * $collection->prepend('Johnie', 'Janie', 'Baby');
     *
     * // ['Johnie', 'Janie', 'Baby', 'John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']
     * ```
     */
    public function prepend (mixed ...$values):void {

        $this->storage = [...$values, ...$this->storage];

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
     * $collection->append('Johnie', 'Janie', 'Baby');
     *
     * // ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard', 'Johnie', 'Janie', 'Baby']
     * ```
     */
    public function append (mixed ...$values):void {

        $this->storage = [...$this->storage, ...$values];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\first() To get the first value from the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $head = $collection->head()
     *
     * // 'John'
     * ```
     */
    public function head ():mixed {

        return first($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\last() To get the last value from the storage.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $tail = $collection->tail();
     *
     * // 'Richard'
     * ```
     */
    public function tail ():mixed {

        return last($this->storage);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Arr\random() To pick one or more random values out of the array.
     *
     * @example
     * ```php
     * use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed;
     *
     * $collection = new Indexed(['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard']);
     *
     * $random = $collection->random($collection2);
     *
     * // ['Jane']
     * ```
     *
     * @throws \FireHub\Core\Support\Exceptions\Arr\OutOfRangeException If an array is empty, or if the number is
     * out of range.
     */
    public function random (int $number = 1):mixed {

        $result = random($this->storage, $number);

        return $number > 1 // @phpstan-ignore return.type
            ? new static($result) // @phpstan-ignore argument.type
            : $result;

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
     * $filter = $collection->filter(fn($value) => $value === 'Jane');
     *
     * // ['Jane', 'Jane', 'Jane']
     * ```
     */
    public function filter (callable $callback):static {

        $storage = [];

        foreach ($this->storage as $key => $value) {

            $result = $callback($value, $key);

            if ($result === 'break') break;
            if ($result) $storage[] = $value;

        }

        return new static($storage);

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
     * $chunk = $collection->chunkWhere(fn($value, $key) => $value === 'Richard');
     *
     * // [['John', 'Jane', 'Jane', 'Jane', 'Richard'], ['Richard']]
     * ```
     */
    public function chunkWhere (callable $callback):Lazy {

        return new Lazy(function () use ($callback) {

            $chunks = [];
            foreach ($this as $key => $value) {

                $chunks[] = $value;

                if ($callback($value, $key)) {

                    yield new static($chunks);

                    $chunks = [];

                }

            }

            if ($chunks) yield new static($chunks);

        });

    }

}
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

use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection;
use Generator, Traversable;

use function FireHub\Core\Support\Helpers\Data\toString;

/**
 * ### Mixed collection type
 *
 * Object collection provides a map from mixed data types.
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection<TKey, TValue>
 *
 * @api
 */
class Mix extends Collection {

    /**
     * ### Underlying storage data
     * @since 1.0.0
     *
     * @var array<string, array{key: ?TKey, value: TValue}>
     */
    protected array $storage = [];

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetExists (mixed $offset):bool {

        return isset($this->storage[$this->key($offset)]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetGet (mixed $offset):mixed {

        return $this->storage[$this->key($offset)]['value'];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetSet (mixed $offset, mixed $value):void {

        $this->storage[$this->key($offset)] = ['key' => $offset, 'value' => $value];

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::key() To resolve key.
     */
    public function offsetUnset (mixed $offset):void {

        unset($this->storage[$this->key($offset)]);

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Mix::yield() To yield key-value.
     */
    public function getIterator ():Traversable {

        yield from $this->yield();

    }

    /**
     * ### Get resolved key
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Data\toString() To convert key to string.
     *
     * @param null|TKey $offset <p>
     * Offset to unset.
     * </p>
     *
     * @return string Resolved key.
     */
    private function key (mixed $offset):string {

        return toString($offset, detailed: true);

    }

    /**
     * ### Yield key-value
     * @since 1.0.0
     *
     * @return Generator Yielded key-value pair.
     */
    private function yield ():Generator {

        foreach ($this->storage as $value)
            yield $value['key'] => $value['value'];

    }

}
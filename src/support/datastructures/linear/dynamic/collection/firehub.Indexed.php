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

use FireHub\Core\Support\DataStructures\Contracts\Arrayable;
use FireHub\Core\Support\LowLevel\Arr;

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
 *
 * @api
 */
class Indexed extends ArrStorage implements Arrayable {

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\LowLevel\Arr::values() To help with removing keys from an array.
     *
     * @caution This collection will reindex the provided array if it is not already numerically indexed.
     */
    public function __construct (array $storage = []) {

        $this->storage = Arr::values($storage);

    }

}
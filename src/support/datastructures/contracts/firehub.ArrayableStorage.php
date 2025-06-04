<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
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

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;

/**
 * ### Arrayable data structure has internal storage as an array
 * @since 1.0.0
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\HighLevel\DataStructures<TKey, TValue>
 * @extends \FireHub\Core\Support\DataStructures\Contracts\Randomble<TKey, TValue>
 * @extends \FireHub\Core\Support\DataStructures\Contracts\Reversible<TKey, TValue>
 * @extends \FireHub\Core\Support\DataStructures\Contracts\Shuffleble<TKey, TValue>
 * @extends \FireHub\Core\Support\DataStructures\Contracts\Sortable<TKey, TValue>
 */
interface ArrayableStorage extends DataStructures, Randomble, Reversible, Shuffleble, Sortable {}
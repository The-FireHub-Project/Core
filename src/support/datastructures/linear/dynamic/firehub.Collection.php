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

/**
 * ### Collection data structure
 * @since 1.0.0
 *
 * @template TKey
 * @template TValue
 *
 * @extends \FireHub\Core\Support\Contracts\HighLevel\DataStructures\Linear\Dynamic<TKey, TValue>
 * @extends \FireHub\Core\Support\Contracts\ArrayAccessible<TKey, TValue>
 */
interface Collection extends Dynamic, ArrayAccessible {

}
<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Initializers
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Initializers\Autoload\Cache;

use FireHub\Core\Initializers\Autoload\Cache;

/**
 * The cache for finding classes from an array
 * @since 1.0.0
 */
final readonly class ClassMap implements Cache {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param array<string, string> $map <p>
     * Array map.
     * </p>
     *
     * @return void
     */
    public function __construct (
        private array $map
    ) {}

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function add (string $key, string $value):bool {

        return true;

    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function get (string $key):string|false {

        return $this->map[$key] ?? false;

    }

}
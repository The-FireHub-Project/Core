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

namespace FireHub\Core\Support\Exceptions\Arr;

use FireHub\Core\Support\Exceptions\ArrException;

/**
 * ### Array item missing key exception
 * @since 1.0.0
 *
 * @method $this withKey (null|int|string $key) ### Array key
 */
class ArrayItemMissingKeyException extends ArrException {

    /**
     * ### Array key
     * @since 1.0.0
     *
     * @var null|int|string
     */
    public null|int|string $key = null {
        set {
            $this->key = $value;
            $this->appendMessage("You provided: {$this->key}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Missing array item key.';

    }

}
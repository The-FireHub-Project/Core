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
 * ### Keys and values must have the same number of elements exception
 * @since 1.0.0
 */
class KeysAndValuesSameNumberOfElemsException extends ArrException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Keys and values must have the same number of elements.';

    }

}
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

namespace FireHub\Core\Support\Exceptions\Data;

use FireHub\Core\Support\Exceptions\DataException;

/**
 * ### Cannot unserialize false or null exception
 * @since 1.0.0
 */
class UnserializeFalseOrNullException extends DataException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {

        $this->message = 'Cannot unserialize because data is already false or data is NULL.';

        parent::__construct();

    }

}
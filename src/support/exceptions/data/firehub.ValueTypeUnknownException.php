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
 * ### Data Exception
 * @since 1.0.0
 */
class ValueTypeUnknownException extends DataException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $internal_type <p>
     * Internal type of value.
     * </p>
     *
     * @return void
     */
    public function __construct (string $internal_type) {

        $this->message = "Type of value is unknown. (internal type: {$internal_type})";

        parent::__construct();

    }

}
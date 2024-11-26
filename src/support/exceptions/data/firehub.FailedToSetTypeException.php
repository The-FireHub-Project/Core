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

use FireHub\Core\Support\Enums\Data\Type;
use FireHub\Core\Support\Exceptions\DataException;

/**
 * ### Failed to set data type exception
 * @since 1.0.0
 */
class FailedToSetTypeException extends DataException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param \FireHub\Core\Support\Enums\Data\Type $type <p>
     * The type that failed to be set.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Type $type
    ) {

        parent::__construct();

        $this->message = 'Failed to set a type to: '.$this->type::class.' for value.';

    }

}
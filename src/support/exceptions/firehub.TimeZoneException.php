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

namespace FireHub\Core\Support\Exceptions;

use FireHub\Core\Support\Enums\DateTime\Zone;
use FireHub\Core\Components\Error\Exception;

/**
 * ### Timezone exception
 * @since 1.0.0
 */
class TimeZoneException extends Exception {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Timezone error.';

    }

    /**
     * ### Sets the character encoding for this exception
     * @since 1.0.0
     *
     * @param null|\FireHub\Core\Support\Enums\DateTime\Zone $zone [optional] <p>
     * The zone to be set.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withTimezone (?Zone $zone = null):static {

        return $this->appendMessageIfExists($zone, 'With zone: '.($zone ? $zone::class : '').'.');

    }

}
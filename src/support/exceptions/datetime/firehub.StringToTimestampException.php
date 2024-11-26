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

namespace FireHub\Core\Support\Exceptions\DateTime;

use FireHub\Core\Support\Exceptions\DateTimeException;

/**
 * ### String to timestamp exception
 * @since 1.0.0
 */
class StringToTimestampException extends DateTimeException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $datetime <p>
     * Date/time string.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $datetime
    ) {

        parent::__construct();

        $this->message = "Could not convert string: {$this->datetime} to timestamp.";

    }

    /**
     * ### Sets the timestamp for this exception
     * @since 1.0.0
     *
     * @param null|int $timestamp [optional] <p>
     * The timestamp.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withTimestamp (?int $timestamp = null):static {

        return $this->appendMessageIfExists($timestamp, 'With timestamp: '.($timestamp ?? '').'.');

    }

}
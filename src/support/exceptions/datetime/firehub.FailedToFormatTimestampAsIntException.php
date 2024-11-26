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
 * ### Failed to format integer exception
 * @since 1.0.0
 */
class FailedToFormatTimestampAsIntException extends DateTimeException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $format <p>
     * Single format character.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $format
    ) {

        parent::__construct();

        $this->message = "Failed to format: {$this->format} a Unix timestamp as integer.";

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
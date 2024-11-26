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
 * ### Sunset and twilight exception
 * @since 1.0.0
 */
class SunsetTwilightException extends DateTimeException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param int $timestamp <p>
     * Unix timestamp.
     * </p>
     * @param float $latitude <p>
     * Latitude in degrees.
     * </p>
     * @param float $longitude <p>
     * Longitude in degrees.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected int $timestamp,
        protected float $latitude,
        protected float $longitude
    ) {

        parent::__construct();

        $this->message = "Could not get information about sunset and twilight for timestamp: {$this->timestamp} with latitude: {$this->latitude} and longitude : {$this->longitude}.";

    }

}
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
 *
 * @method $this withTimestamp (?int $timestamp) ### Timestamp
 * @method $this withLatitude (?float $latitude) ### Latitude
 * @method $this withLongitude (?float $longitude) ### Longitude
 */
class SunsetTwilightException extends DateTimeException {

    /**
     * ### Timestamp
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $timestamp = null {
        set {
            $this->timestamp = $value;
            $this->appendMessage("With timestamp: {$this->timestamp}.");
        }
    }

    /**
     * ### Latitude
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $latitude = null {
        set {
            $this->latitude = $value;
            $this->appendMessage("With latitude: {$this->latitude}.");
        }
    }

    /**
     * ### Longitude
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $longitude = null {
        set {
            $this->longitude = $value;
            $this->appendMessage("With longitude: {$this->longitude}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Could not get information about sunset and twilight for timestamp';

    }

}
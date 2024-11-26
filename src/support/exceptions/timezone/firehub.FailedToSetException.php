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

namespace FireHub\Core\Support\Exceptions\TimeZone;

use FireHub\Core\Support\Enums\DateTime\Zone;
use FireHub\Core\Support\Exceptions\TimeZoneException;

/**
 * ### Failed to set timezone exception
 * @since 1.0.0
 */
class FailedToSetException extends TimeZoneException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param \FireHub\Core\Support\Enums\DateTime\Zone $zone <p>
     * Timezone parameter.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected Zone $zone
    ) {

        parent::__construct();

        $this->message = 'Failed to set timezone to.'. $this->zone::class;

    }

}
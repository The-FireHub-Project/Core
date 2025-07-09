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
 *
 * @method $this withZone (?Zone $zone) ### Zone
 */
class FailedToSetException extends TimeZoneException {

    /**
     * ### Zone
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $zone = null {
        set {
            $this->zone = $value;
            $this->appendMessage("Tried with zone: {$this->zone}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Failed to set timezone';

    }

}
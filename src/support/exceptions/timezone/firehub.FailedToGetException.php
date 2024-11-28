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

use FireHub\Core\Support\Exceptions\TimeZoneException;

/**
 * ### Failed to get timezone exception
 * @since 1.0.0
 *
 * @method $this withInternal (?string $internal) ### Internal timezone
 */
class FailedToGetException extends TimeZoneException {

    /**
     * ### Internal timezone
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $internal = null {
        set {
            $this->internal = $value;
            $this->appendMessage("Internal timezone: {$this->internal}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Failed to get timezone';

    }

}
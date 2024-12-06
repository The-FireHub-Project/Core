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

use FireHub\Core\Components\Error\Exception;

/**
 * ### Timestamp exception
 * @since 1.0.0
 *
 * @method $this withTimestamp (?int $timestamp) ### Timestamp
 */
class TimestampException extends Exception {

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
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Timestamp error.';

    }

}
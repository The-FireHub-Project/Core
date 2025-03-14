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
 * ### Parse from format exception
 * @since 1.0.0
 *
 * @method $this withFormat (?string $format) ### Format
 * @method $this withDatetime (?string $datetime) ### Datetime
 */
class ParseFromFormatException extends DateTimeException {

    /**
     * ### Format
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $format = null {
        set {
            $this->format = $value;
            $this->appendMessage("Using format: {$this->format}.");
        }
    }

    /**
     * ### Datetime
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $datetime = null {
        set {
            $this->datetime = $value;
            $this->appendMessage("With datetime: {$this->datetime}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Error parsing datetime from format.';

    }

}
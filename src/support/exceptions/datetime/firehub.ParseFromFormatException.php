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
 */
class ParseFromFormatException extends DateTimeException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param string $format <p>
     * The date/time format.
     * </p>
     * @param string $datetime <p>
     * Date/time string.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected string $format,
        protected string $datetime
    ) {

        parent::__construct();

        $this->message = "Parse from format: {$this->format} for datetime: {$this->datetime}.";

    }

}
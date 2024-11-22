<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Components
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Components\Error;

use Exception as InternalException;

/**
 * ### Main Exception
 * @since 1.0.0
 */
class Exception extends InternalException {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct () {

        parent::__construct();

    }

    /**
     * ### Sets the exception message
     * @since 1.0.0
     *
     * @param string $message <p>
     * The exception message.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withMessage (string $message):static {

        $this->message = $message;

        return $this;

    }

    /**
     * ### Append a message to the exception message
     * @since 1.0.0
     *
     * @param string $message <p>
     * The exception message to append.
     * </p>
     *
     * @return static This exception instance.
     */
    public function appendMessage (string $message):static {

        $this->message .= ' '.$message; // @phpstan-ignore assignOp.invalid

        return $this;

    }

    /**
     * ### Append a message to the exception message only if $check exists
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Components\Error\Exception::appendMessage() To append an error message in case of $check
     * assignment exists.
     *
     * @param mixed $check <p>
     * Value to check if is set.
     * </p>
     * @param string $message <p>
     * The exception message to append.
     * </p>
     *
     * @return static This exception instance.
     */
    public function appendMessageIfExists (mixed $check, string $message):static {

        return isset($check) ? $this->appendMessage($message) : $this;

    }

    /**
     * ### Sets the exception code
     * @since 1.0.0
     *
     * @param int $code <p>
     * The exception code.
     * </p>
     *
     * @return static This exception instance.
     */
    public function withCode (int $code):static {

        $this->code = $code;

        return $this;

    }

}
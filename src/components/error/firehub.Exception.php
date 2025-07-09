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

use function FireHub\Core\Support\Helpers\Data\toString;
use function ltrim;
use function preg_replace;
use function property_exists;
use function strtolower;

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

    /**
     * ### Invoking methods to set property
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Helpers\Data\toString() To shown argument as string.
     *
     * @param non-empty-string $method <p>
     * Method name.
     * </p>
     * @param array<array-key, mixed> $arguments <p>
     * List of arguments.
     * </p>
     *
     * @return static Method return.
     */
    public function __call (string $method, array $arguments):static {

        if (
            isset($arguments[0])
            && property_exists(
                $this,
                $method = strtolower(
                    ltrim(
                        preg_replace('~[a-z]\K(?=[A-Z])~', '_', $method) ?? '',
                        'with_'
                    )
                )
            )
        ) $this->$method = toString($arguments[0], '{unknown value}', true);

        return $this;

    }

}
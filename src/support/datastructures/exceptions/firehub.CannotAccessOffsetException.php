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

namespace FireHub\Core\Support\DataStructures\Exceptions;

/**
 * ### Cannot access offset Exception
 * @since 1.0.0
 *
 * @method $this withValue (mixed $value) ### Value to access
 */
class CannotAccessOffsetException extends DataStructureException {

    /**
     * ### Offset value
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $value = null {
        set {
            $this->value = $value;
            $this->appendMessage("With value: {$this->value}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot access offset in isset or empty';

    }

}
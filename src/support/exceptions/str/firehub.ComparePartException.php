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

namespace FireHub\Core\Support\Exceptions\Str;

use FireHub\Core\Support\Exceptions\StrException;

/**
 * ### Compare part exception
 * @since 1.0.0
 *
 * @method $this withString2 (?string $string_2) ### String 2
 * @method $this withOffset (?int $offset) ### Offset
 * @method $this withLength (?int $length) ### Length
 * @method $this withCaseSensitive (?bool $case_sensitive) ### Case sensitive
 */
class ComparePartException extends StrException {

    /**
     * ### String 2
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $string_2 = null {
        set {
            $this->string_2 = $value;
            $this->appendMessage("Comparing with: {$this->string_2}.");
        }
    }

    /**
     * ### Offset
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $offset = null {
        set {
            $this->offset = $value;
            $this->appendMessage("With offset: {$this->offset}.");
        }
    }

    /**
     * ### Length
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $length = null {
        set {
            $this->length = $value;
            $this->appendMessage("Using length: {$this->length}.");
        }
    }

    /**
     * ### Case sensitive
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $case_sensitive = null {
        set {
            $this->case_sensitive = $value;
            $this->appendMessage("Case sensitive: {$this->case_sensitive}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Failed to compare part of the sting.';

    }

}
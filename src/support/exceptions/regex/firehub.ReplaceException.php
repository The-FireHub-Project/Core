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

namespace FireHub\Core\Support\Exceptions\Regex;

use FireHub\Core\Support\Exceptions\RegexException;

/**
 * ### Search and replace exception
 * @since 1.0.0
 *
 * @method $this withReplacement (?string $replacement) ### Replacement
 * @method $this withString (?string $string) ### String
 * @method $this withLimit (?int $limit) ### Limit
 * @method $this withCaseSensitive (?bool $case_sensitive) ### Case sensitive
 */
class ReplaceException extends RegexException {

    /**
     * ### Replacement
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $replacement = null {
        set {
            $this->replacement = $value;
            $this->appendMessage("Using replacement: {$this->replacement}.");
        }
    }

    /**
     * ### String
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $string = null {
        set {
            $this->string = $value;
            $this->appendMessage("On string: {$this->string}.");
        }
    }

    /**
     * ### Limit
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $limit = null {
        set {
            $this->limit = $value;
            $this->appendMessage("With limit: {$this->limit}.");
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
            $this->appendMessage("Case sensitive is: {$this->case_sensitive}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Error while performing a regular expression search and replace.';

    }

}
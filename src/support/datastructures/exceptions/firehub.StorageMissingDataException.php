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
 * ### Storage is missing data Exception
 * @since 1.0.0
 *
 * @method $this withData (mixed $data) ### Data provided
 * @method $this withKey (mixed $key) ### Key needed inside $data
 */
class StorageMissingDataException extends DataStructureException {

    /**
     * ### Storage data
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $data = null {
        set {
            $this->data = $value;
            $this->appendMessage("With Data: {$this->data}.");
        }
    }

    /**
     * ### Needs key
     * @since 1.0.0
     *
     * @var null|int|string
     */
    public null|int|string $key = null {
        set {
            $this->key = $value;
            $this->appendMessage("With Key: {$this->key}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Missing data to transform data to storage data.';

    }

}
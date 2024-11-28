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

namespace FireHub\Core\Support\Exceptions\FileSystem;

use FireHub\Core\Support\Enums\FileSystem\Permission;
use FireHub\Core\Support\Exceptions\FileSystemException;

/**
 * ### Set permissions exception
 * @since 1.0.0
 *
 * @method $this withPermissions (null|int|float $permissions) ### Permissions
 * @method $this withOwner (?Permission $permissions) ### Owner
 * @method $this withOwnerGroup (?Permission $permissions) ### Owner group
 * @method $this withGlobal (?Permission $permissions) ### Global
 */
class SetPermissionsException extends FileSystemException {

    /**
     * ### Permissions
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $permissions = null {
        set {
            $this->permissions = $value;
            $this->appendMessage("With permissions: {$this->permissions}.");
        }
    }

    /**
     * ### Owner
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $owner = null {
        set {
            $this->owner = $value;
            $this->appendMessage("With owner permissions: {$this->owner}.");
        }
    }

    /**
     * ### Owner group
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $owner_group = null {
        set {
            $this->owner_group = $value;
            $this->appendMessage("With owner_group permissions: {$this->owner_group}.");
        }
    }

    /**
     * ### Global
     * @since 1.0.0
     *
     * @var null|non-empty-string
     */
    public ?string $global = null {
        set {
            $this->global = $value;
            $this->appendMessage("With global permissions: {$this->global}.");
        }
    }

    /**
     * @inheritDoc
     *
     * @since 1.0.0
     */
    public function __construct () {

        parent::__construct();

        $this->message = 'Cannot set permissions for path.';

    }

}
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

namespace FireHub\Core\Support\LowLevel;

use FireHub\Core\Support\Enums\Data\ResourceType;

use function get_resource_id;
use function get_resource_type;
use function get_resources;

/**
 * ### Resource low-level proxy class
 *
 * Class allows you to collect information about resources.
 * @since 1.0.0
 */
final class Resources {

    /**
     * ### Returns an integer identifier for the given resource
     *
     * This function provides a type-safe way of generating the integer identifier for a resource.
     * @since 1.0.0
     *
     * @param resource $resource <p>
     * The evaluated resource handle.
     * </p>
     *
     * @return int The identifier for the given resource.
     */
    public static function id (mixed $resource):int {

        return get_resource_id($resource);

    }

    /**
     * ### Gets the resource type
     * @since 1.0.0
     *
     * @param resource $resource <p>
     * The evaluated resource handle.
     * </p>
     *
     * @return \FireHub\Core\Support\Enums\Data\ResourceType Resource type or null if is not a resource.
     */
    public static function type (mixed $resource):ResourceType {

        return ResourceType::from(get_resource_type($resource));

    }

    /**
     * ### Get active resources
     *
     * Returns an array of all currently active resources, optionally filtered by resource type.
     * @since 1.0.0
     *
     * @param null|\FireHub\Core\Support\Enums\Data\ResourceType $type [optional] <p>
     * If defined, this will cause the method to only return resources of the given type.
     * </p>
     *
     * @return array<int, resource> Resource type or null if is not a resource.
     */
    public static function active (?ResourceType $type = null):array {

        return get_resources($type?->value);

    }

}
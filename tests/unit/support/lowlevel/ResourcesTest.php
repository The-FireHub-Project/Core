<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Test
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace support\lowlevel;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\Enums\Data\ResourceType;
use FireHub\Core\Support\LowLevel\Resources;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test resource low-level proxy lass
 * @since 1.0.0
 */
#[Small]
#[Group('lowlevel')]
#[CoversClass(Resources::class)]
#[CoversClass(ResourceType::class)]
final class ResourcesTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testId ():void {

        $this->assertIsInt(Resources::id($this->resource()));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testType ():void {

        $this->assertSame(ResourceType::STREAM, Resources::type($this->resource()));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testActive ():void {

        $this->assertIsArray(Resources::active());

    }

    /**
     * @since 1.0.0
     *
     * @return resource
     */
    private static function resource ():mixed {

        return fopen('php://stdout', 'w');

    }

}
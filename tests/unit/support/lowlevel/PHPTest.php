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
use FireHub\Core\Support\LowLevel\PHP;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test PHP low-level proxy class
 * @since 1.0.0
 */
#[Small]
#[Group('lowlevel')]
#[CoversClass(PHP::class)]
final class PHPTest extends Base {

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIsExtensionLoaded ():void {

        $this->assertTrue(PHP::isExtensionLoaded('Core'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testLoadedExtension ():void {

        $this->assertIsArray(PHP::loadedExtensions());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testExtensionFunctions ():void {

        $this->assertIsArray(PHP::extensionFunctions('Core'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testScriptOwner ():void {

        $this->assertIsString(PHP::scriptOwner());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testIncludedFiles ():void {

        $this->assertIsArray(PHP::includedFiles());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSetEnvironmentVariables ():void {

        $this->assertTrue(PHP::setEnvironmentVariable('FOO=BAR'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetEnvironmentVariables ():void {

        $this->assertSame('BAR', PHP::getEnvironmentVariable('FOO'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetConfigurationPath ():void {

        $this->assertIsString(PHP::getConfigurationPath());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetConfigurationOption ():void {

        $this->assertIsString(PHP::getConfigurationOption('display_errors'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetConfigurationOptions ():void {

        $this->assertIsArray(PHP::getConfigurationOptions());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testParseConfigurationQuantity ():void {

        $this->assertIsInt(PHP::parseConfigurationQuantity('1024M'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testProcessID ():void {

        $this->assertIsInt(PHP::processID());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testServerAPI ():void {

        $this->assertIsString(PHP::serverAPI());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testOsInfo ():void {

        $this->assertIsArray(PHP::osInfo());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testVersion ():void {

        $this->assertIsString(PHP::version());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCompareVersion ():void {

        $this->assertSame(-1, PHP::compareVersion('1.0.0', '1.0.1'));

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testZendVersion ():void {

        $this->assertIsString(PHP::zendVersion());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testTempFolder ():void {

        $this->assertIsString(PHP::tempFolder());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetMemoryUsage ():void {

        $this->assertIsInt(PHP::getMemoryUsage());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGetMemoryPeakUsage ():void {

        $this->assertIsInt(PHP::getMemoryPeakUsage());

    }

}
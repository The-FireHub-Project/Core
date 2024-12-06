<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * This is a landing file if the PHAR archive is accessed through a web browser.
 * @since 1.0.0
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Public
 *
 * @version GIT: $Id$ Blob checksum.
 */

require __DIR__.'/../initializers/firehub.FireHubConfigurator.php';

use FireHub\Core\Initializers\FireHubConfigurator;
use FireHub\Core\Kernel\Http;

/**
 * ### Let there be light
 * @since 1.0.0
 *
 * @return \FireHub\Core\FireHub
 */
return new FireHubConfigurator()
    ->withBootloaders([
        //
    ])
    ->withKernel(Http::class)
    ->create()
    ->boot();
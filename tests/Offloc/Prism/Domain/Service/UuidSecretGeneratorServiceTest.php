<?php

/*
 * This file is a part of offloc/prism.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Prism\Domain\Service;

/**
 * Defines the UUID Secret Generator service test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class UuidSecretGeneratorServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test generateSecret returns a properly formatted UUID
     */
    public function testGenerateSecret()
    {
        $secretGeneratorService = new UuidSecretGeneratorService;

        $this->assertRegexp(
            '/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i',
            $secretGeneratorService->generateSecret()
        );
    }
}

<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Tests\Router\Domain\Service;

use Offloc\Router\Domain\Service\DflydevIdentityGeneratorService;

/**
 * Defines the UUID Secret Generator service test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class DflydevIdentityGeneratorServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test generate identity
     */
    public function testGenerateIdentity()
    {
        $mockDflydevIdentityGenerator = $this
            ->getMockBuilder('Dflydev\IdentityGenerator\IdentityGenerator')
            ->disableOriginalConstructor()
            ->getMock();
        $mockDflydevIdentityGenerator
            ->expects($this->once())
            ->method('generate')
            ->with($this->equalTo(null))
            ->will($this->returnValue('newIdentity'));

        $identityGenerator = new DflydevIdentityGeneratorService($mockDflydevIdentityGenerator);

        $this->assertEquals('newIdentity', $identityGenerator->generateIdentity());
    }

    /**
     * Test generate identity (with suggestion)
     */
    public function testGenerateIdentityWithSuggestion()
    {
        $mockDflydevIdentityGenerator = $this
            ->getMockBuilder('Dflydev\IdentityGenerator\IdentityGenerator')
            ->disableOriginalConstructor()
            ->getMock();
        $mockDflydevIdentityGenerator
            ->expects($this->once())
            ->method('generate')
            ->with($this->equalTo('newIdentity'))
            ->will($this->returnValue('newIdentity'));

        $identityGenerator = new DflydevIdentityGeneratorService($mockDflydevIdentityGenerator);

        $this->assertEquals('newIdentity', $identityGenerator->generateIdentity('newIdentity'));
    }
}

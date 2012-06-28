<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Tests\Router\Domain\Model\Service;

use Offloc\Router\Domain\Model\Service\ServiceFactory;

/**
 * Defines the Service factory test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function getServiceFactory()
    {
        $keyGenerator = $this->getMock('Offloc\Router\Domain\Service\KeyGeneratorServiceInterface');
        $keyGenerator
            ->expects($this->once())
            ->method('generateKey')
            ->will($this->returnValue('some key'));

        $secretGenerator = $this->getMock('Offloc\Router\Domain\Service\SecretGeneratorServiceInterface');
        $secretGenerator
            ->expects($this->once())
            ->method('generateSecret')
            ->will($this->returnValue('some secret'));

        return new ServiceFactory($keyGenerator, $secretGenerator);
    }

    /**
     * Test creating service (should be active, explicit)
     */
    public function testCreateActiveExplicit()
    {
        $serviceFactory = $this->getServiceFactory();
        $service = $serviceFactory->create('service name', 'http://example.com', true);

        $this->assertEquals('some key', $service->key());
        $this->assertEquals('some secret', $service->secret());
        $this->assertEquals('service name', $service->name());
        $this->assertEquals('http://example.com', $service->url());
        $this->assertTrue($service->active());
    }

    /**
     * Test creating service (should be inactive)
     */
    public function testCreateInactive()
    {
        $serviceFactory = $this->getServiceFactory();
        $service = $serviceFactory->create('service name', 'http://example.com', false);

        $this->assertEquals('some key', $service->key());
        $this->assertEquals('some secret', $service->secret());
        $this->assertEquals('service name', $service->name());
        $this->assertEquals('http://example.com', $service->url());
        $this->assertFalse($service->active());
    }
}
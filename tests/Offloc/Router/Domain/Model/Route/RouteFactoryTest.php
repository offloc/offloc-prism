<?php

/*
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Model\Route;

use Offloc\Router\Domain\Model\Service\Service;
use Offloc\Router\Domain\Service\IdentityGeneratorServiceInterface;

/**
 * Defines the Route factory test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class RouteFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function getService()
    {
        return new Service('some key', 'some name', 'http://example.com');
    }

    protected function getIdentityGenerator()
    {
        return  $this->getMock('Offloc\Router\Domain\Service\IdentityGeneratorServiceInterface');
    }

    protected function getRouteFactory(IdentityGeneratorServiceInterface $idGenerator = null)
    {
        if (null === $idGenerator) {
            $idGenerator = $this->getIdentityGenerator();
        }

        return new RouteFactory($idGenerator);
    }

    /**
     * Test creating route
     */
    public function testCreate()
    {
        $idGenerator = $this->getIdentityGenerator();
        $routeFactory = $this->getRouteFactory($idGenerator);
        $service = $this->getService();

        $idGenerator
            ->expects($this->once())
            ->method('generateIdentity')
            ->will($this->returnValue('some random id'));

        $route = $routeFactory->create($service, 'http://example.com/', 'some route');

        $this->assertEquals($service, $route->service());
        $this->assertEquals('http://example.com/', $route->target());
        $this->assertEquals('some route', $route->name());
        $this->assertEquals('some random id', $route->id());
    }

    /**
     * Test creating route (with headers)
     */
    public function testCreateWithHeaders()
    {
        $routeFactory = $this->getRouteFactory();
        $service = $this->getService();

        $route = $routeFactory->create($service, 'http://example.com/', 'some route', null, array('hello' => 'world'));

        $this->assertEquals('world', $route->getHeader('hello'));
    }

    /**
     * Test creating route (with identity suggestion)
     */
    public function testCreateWithSuggestedIdentity()
    {
        $idGenerator = $this->getIdentityGenerator();
        $routeFactory = $this->getRouteFactory($idGenerator);
        $service = $this->getService();

        $idGenerator
            ->expects($this->once())
            ->method('generateIdentity')
            ->with($this->equalTo('SUGGESTED ID'))
            ->will($this->returnValue('SUGGESTED ID'));

        $route = $routeFactory->create($service, 'http://example.com/', 'some route', 'SUGGESTED ID');

        $this->assertEquals('SUGGESTED ID', $route->id());
    }
}

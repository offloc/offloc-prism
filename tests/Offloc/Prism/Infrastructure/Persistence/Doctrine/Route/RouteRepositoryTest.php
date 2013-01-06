<?php

/*
 * This file is a part of offloc/prism.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Prism\Infrastructure\Persistence\Doctrine\Route;

use Offloc\Prism\Domain\Model\Route\Route;
use Offloc\Prism\Domain\Model\Service\Service;

/**
 * Defines the Route repository test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class RouteRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected function getMockSession()
    {
        return $this->getMock('Offloc\Prism\Domain\Model\SessionInterface');
    }

    protected function getMockRouteObjectRepository()
    {
        return $this
            ->getMockBuilder('Doctrine\Common\Persistence\ObjectRepository')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function getTestService($fudge = '')
    {
        if (strlen($fudge) > 0) {
            $fudge .= ' ';
        }

        return new Service($fudge.'some key', $fudge.'some service', 'http://example.com', $fudge.'some secret');
    }

    protected function getTestRoute(Service $service = null, $fudge = '')
    {
        if (strlen($fudge) > 0) {
            $fudge .= ' ';
        }

        if (null === $service) {
            $service = $this->getTestService($fudge);
        }

        return new Route($service, $fudge.'some id', 'http://examp.le/'.$fudge, $fudge.'some route');
    }

    /**
     * Test find method
     */
    public function testFind()
    {
        $testRoute = $this->getTestRoute();

        $session = $this->getMockSession();
        $routeObjectRepository = $this->getMockRouteObjectRepository();

        $routeObjectRepository
            ->expects($this->once())
            ->method('find')
            ->with($this->equalTo('some id'))
            ->will($this->returnValue($testRoute));

        $routeRepository = new RouteRepository($session, $routeObjectRepository);

        $route = $routeRepository->find('some id');

        $this->assertEquals('some route', $route->name());
    }

    /**
     * Test findByService method
     */
    public function testFindByService()
    {
        $testService = $this->getTestService();
        $testRoute000 = $this->getTestRoute($testService, '000');
        $testRoute001 = $this->getTestRoute($testService, '001');

        $session = $this->getMockSession();
        $routeObjectRepository = $this->getMockRouteObjectRepository();

        $routeObjectRepository
            ->expects($this->once())
            ->method('findBy')
            ->with($this->equalTo(array('service' => $testService)))
            ->will($this->returnValue(array($testRoute000, $testRoute001)));

        $routeRepository = new RouteRepository($session, $routeObjectRepository);

        $routes = $routeRepository->findByService($testService);

        $this->assertEquals('000 some route', $routes[0]->name());
        $this->assertEquals('001 some route', $routes[1]->name());
    }

    /**
     * Test store method
     */
    public function testStore()
    {
        $testRoute = $this->getTestRoute();

        $session = $this->getMockSession();
        $routeObjectRepository = $this->getMockRouteObjectRepository();

        $session
            ->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($testRoute));

        $routeRepository = new RouteRepository($session, $routeObjectRepository);

        $routeRepository->store($testRoute);
    }

    /**
     * Test remove method
     */
    public function testRemove()
    {
        $testRoute = $this->getTestRoute();

        $session = $this->getMockSession();
        $routeObjectRepository = $this->getMockRouteObjectRepository();

        $session
            ->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($testRoute));

        $routeRepository = new RouteRepository($session, $routeObjectRepository);

        $routeRepository->remove($testRoute);
    }
}

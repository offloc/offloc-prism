<?php

/*
 * This file is a part of offloc/prism.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Prism\Infrastructure\Persistence\Doctrine\Service;

use Offloc\Prism\Domain\Model\Service\Service;

/**
 * Defines the Service repository test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected function getMockSession()
    {
        return $this->getMock('Offloc\Prism\Domain\Model\SessionInterface');
    }

    protected function getMockServiceObjectRepository()
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

    /**
     * Test find method
     */
    public function testFind()
    {
        $testService = $this->getTestService();

        $session = $this->getMockSession();
        $serviceObjectRepository = $this->getMockServiceObjectRepository();

        $serviceObjectRepository
            ->expects($this->once())
            ->method('find')
            ->with($this->equalTo('some key'))
            ->will($this->returnValue($testService));

        $serviceRepository = new ServiceRepository($session, $serviceObjectRepository);

        $service = $serviceRepository->find('some key');

        $this->assertEquals('some service', $service->name());
    }

    /**
     * Test findAll method
     */
    public function testFindAll()
    {
        $testService000 = $this->getTestService('000');
        $testService001 = $this->getTestService('001');

        $session = $this->getMockSession();
        $serviceObjectRepository = $this->getMockServiceObjectRepository();

        $serviceObjectRepository
            ->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue(array($testService000, $testService001)));

        $serviceRepository = new ServiceRepository($session, $serviceObjectRepository);

        $services = $serviceRepository->findAll();

        $this->assertEquals('000 some service', $services[0]->name());
        $this->assertEquals('001 some service', $services[1]->name());
    }

    /**
     * Test findByName method
     */
    public function testFindByName()
    {
        $testService = $this->getTestService();

        $session = $this->getMockSession();
        $serviceObjectRepository = $this->getMockServiceObjectRepository();

        $serviceObjectRepository
            ->expects($this->once())
            ->method('findBy')
            ->with($this->equalTo(array('name' => 'some service')))
            ->will($this->returnValue(array($testService)));

        $serviceRepository = new ServiceRepository($session, $serviceObjectRepository);

        $services = $serviceRepository->findByName('some service');

        $this->assertEquals('some service', $services[0]->name());
    }

    /**
     * Test store method
     */
    public function testStore()
    {
        $testService = $this->getTestService();

        $session = $this->getMockSession();
        $serviceObjectRepository = $this->getMockServiceObjectRepository();

        $session
            ->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($testService));

        $serviceRepository = new ServiceRepository($session, $serviceObjectRepository);

        $serviceRepository->store($testService);
    }

    /**
     * Test remove method
     */
    public function testRemove()
    {
        $testService = $this->getTestService();

        $session = $this->getMockSession();
        $serviceObjectRepository = $this->getMockServiceObjectRepository();

        $session
            ->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($testService));

        $serviceRepository = new ServiceRepository($session, $serviceObjectRepository);

        $serviceRepository->remove($testService);
    }
}

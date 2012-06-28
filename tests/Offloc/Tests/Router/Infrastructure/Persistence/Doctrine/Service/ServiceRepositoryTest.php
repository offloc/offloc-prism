<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Tests\Router\Infrastructure\Persistence\Doctrine\Service;

use Offloc\Router\Domain\Model\Service\Service;
use Offloc\Router\Infrastructure\Persistence\Doctrine\Service\ServiceRepository;

/**
 * Defines the Service factory test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceRepositoryTest extends \PHPUnit_Framework_TestCase
{
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
        $entityRepository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $entityRepository
            ->expects($this->once())
            ->method('find')
            ->with($this->equalTo('some key'))
            ->will($this->returnValue($testService));

        $serviceRepository = new ServiceRepository($entityRepository);

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
        $entityRepository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $entityRepository
            ->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue(array($testService000, $testService001)));

        $serviceRepository = new ServiceRepository($entityRepository);

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
        $entityRepository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $entityRepository
            ->expects($this->once())
            ->method('findBy')
            ->with($this->equalTo(array('name' => 'some service')))
            ->will($this->returnValue(array($testService)));

        $serviceRepository = new ServiceRepository($entityRepository);

        $services = $serviceRepository->findByName('some service');

        $this->assertEquals('some service', $services[0]->name());
    }

    /**
     * Test store method
     */
    public function testStore()
    {
        return;

        $testService = $this->getTestService();
        $entityRepository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $entityRepository
            ->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($testService));

        $serviceRepository = new ServiceRepository($entityRepository);

        $serviceRepository->store($testService);

        $this->markTestIncomplete("Cannot seem to mock EntityManager w/ persist method");
    }

    /**
     * Test remove method
     */
    public function testRemove()
    {
        return;

        $testService = $this->getTestService();
        $entityRepository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $entityRepository
            ->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($testService));

        $serviceRepository = new ServiceRepository($entityRepository);

        $serviceRepository->remove($testService);

        $this->markTestIncomplete("Cannot seem to mock EntityManager w/ remove method");
    }
}
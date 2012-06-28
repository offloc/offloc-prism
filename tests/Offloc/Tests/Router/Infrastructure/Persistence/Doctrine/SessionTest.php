<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Tests\Router\Infrastructure\Persistence\Doctrine;

use Offloc\Router\Infrastructure\Persistence\Doctrine\Session;

/**
 * Defines the Session test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup
     */
    public function setUp()
    {
        if (!class_exists('Doctrine\ORM\EntityManager')) {
            $this->markTestSkipped('The Doctrine ORM library is not available');
        }
    }

    protected function getEntityManager()
    {
        return $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Test persist method
     */
    public function testPersist()
    {
        $object = new SessionTestPlaceholder('testing');

        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($object));

        $session = new Session($entityManager);

        $session->persist($object);
    }

    /**
     * Test remove method
     */
    public function testRemove()
    {
        $object = new SessionTestPlaceholder('testing');

        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($object));

        $session = new Session($entityManager);

        $session->remove($object);
    }

    /**
     * Test merge method
     */
    public function testMerge()
    {
        $object = new SessionTestPlaceholder('testing');

        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('merge')
            ->with($this->equalTo($object));

        $session = new Session($entityManager);

        $session->merge($object);
    }

    /**
     * Test clear method (default)
     */
    public function testClearDefault()
    {
        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('clear');

        $session = new Session($entityManager);

        $session->clear();
    }

    /**
     * Test clear method (named class)
     */
    public function testClearNamed()
    {
        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('clear')
            ->with($this->equalTo('Example\Model\ClassName'));

        $session = new Session($entityManager);

        $session->clear('Example\Model\ClassName');
    }

    /**
     * Test detach method
     */
    public function testDetach()
    {
        $object = new SessionTestPlaceholder('testing');

        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('detach')
            ->with($this->equalTo($object));

        $session = new Session($entityManager);

        $session->detach($object);
    }

    /**
     * Test refresh method
     */
    public function testRefresh()
    {
        $object = new SessionTestPlaceholder('testing');

        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('refresh')
            ->with($this->equalTo($object));

        $session = new Session($entityManager);

        $session->refresh($object);
    }

    /**
     * Test flush method
     */
    public function testFlush()
    {
        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('flush');

        $session = new Session($entityManager);

        $session->flush();
    }

    /**
     * Test transactional method
     */
    public function testTransactional()
    {
        $object = new SessionTestPlaceholder('testing');

        $callback = function() {
            // empty
        };

        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('transactional')
            ->with($this->equalTo($callback));

        $session = new Session($entityManager);

        $session->transactional($callback);
    }
}

<?php

/*
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Infrastructure\Persistence\Doctrine;

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

        $thatSession = $session->persist($object);
        $this->assertEquals($thatSession, $session);
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

        $thatSession = $session->remove($object);
        $this->assertEquals($thatSession, $session);
    }

    /**
     * Test merge method
     */
    public function testMerge()
    {
        $object = new SessionTestPlaceholder('testing');
        $mergedObject = new SessionTestPlaceholder('merged testing');

        $entityManager = $this->getEntityManager();
        $entityManager
            ->expects($this->once())
            ->method('merge')
            ->with($this->equalTo($object))
            ->will($this->returnValue($mergedObject));

        $session = new Session($entityManager);

        $thatObject = $session->merge($object);
        $this->assertEquals($thatObject, $mergedObject);
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

        $thatSession = $session->clear();
        $this->assertEquals($thatSession, $session);
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

        $thatSession = $session->clear('Example\Model\ClassName');
        $this->assertEquals($thatSession, $session);
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

        $thatSession = $session->detach($object);
        $this->assertEquals($thatSession, $session);
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

        $thatSession = $session->refresh($object);
        $this->assertEquals($thatSession, $session);
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

        $thatSession = $session->flush();
        $this->assertEquals($thatSession, $session);
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

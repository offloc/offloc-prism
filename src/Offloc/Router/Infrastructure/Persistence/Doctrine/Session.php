<?php

/**
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Offloc\Router\Domain\Model\SessionInterface;

/**
 * Defines the Session interface
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Session implements SessionInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager Entity manager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function persist($object)
    {
        return $this->entityManager->persist($object);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($object)
    {
        return $this->entityManager->remove($object);
    }

    /**
     * {@inheritdoc}
     */
    public function merge($object)
    {
        return $this->entityManager->merge($object);
    }

    /**
     * {@inheritdoc}
     */
    public function clear($objectName = null)
    {
        return $this->entityManager->clear($objectName);
    }

    /**
     * {@inheritdoc}
     */
    public function detach($object)
    {
        return $this->entityManager->detach($object);
    }

    /**
     * {@inheritdoc}
     */
    public function refresh($object)
    {
        return $this->entityManager->refresh($object);
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        return $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function transactional($func)
    {
        return $this->entityManager->transactional($func);
    }
}

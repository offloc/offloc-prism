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
        $this->entityManager->persist($object);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($object)
    {
        $this->entityManager->remove($object);

        return $this;
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
        $this->entityManager->clear($objectName);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function detach($object)
    {
        $this->entityManager->detach($object);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function refresh($object)
    {
        $this->entityManager->refresh($object);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        $this->entityManager->flush();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function transactional($func)
    {
        return $this->entityManager->transactional($func);
    }
}

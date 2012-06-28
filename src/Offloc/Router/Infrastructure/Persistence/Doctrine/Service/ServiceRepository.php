<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Infrastructure\Persistence\Doctrine\Service;

use Doctrine\ORM\EntityRepository;
use Offloc\Router\Domain\Model\Service\Service;
use Offloc\Router\Domain\Model\Service\ServiceRepositoryInterface;

/**
 * Doctrine implementation of the Service Repository
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var EntityRepository
     */
    private $serviceRepository;

    /**
     * Constructor
     *
     * @param EntityRepository $serviceRepository Service repository
     */
    public function __construct(EntityRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function find($key)
    {
        return $this->serviceRepository->find($key);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        return $this->serviceRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        return $this->serviceRepository->findBy(array('name' => $name));
    }

    /**
     * {@inheritdoc}
     */
    public function store(Service $service)
    {
        $this->serviceRepository->persist($service);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(Service $service)
    {
        $this->serviceRepository->remove($service);
    }
}

<?php

/*
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Infrastructure\Persistence\Doctrine\Service;

use Doctrine\Common\Persistence\ObjectRepository;
use Offloc\Router\Domain\Model\Service\Service;
use Offloc\Router\Domain\Model\Service\ServiceRepositoryInterface;
use Offloc\Router\Domain\Model\SessionInterface;

/**
 * Doctrine implementation of the Service Repository
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var ObjectRepository
     */
    private $serviceRepository;

    /**
     * Constructor
     *
     * @param SessionInterface $session           Session
     * @param ObjectRepository $serviceRepository Service repository
     */
    public function __construct(SessionInterface $session, ObjectRepository $serviceRepository)
    {
        $this->session = $session;
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
        $this->session->persist($service);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(Service $service)
    {
        $this->session->remove($service);
    }
}

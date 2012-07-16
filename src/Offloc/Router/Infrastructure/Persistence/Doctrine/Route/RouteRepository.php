<?php

/*
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Infrastructure\Persistence\Doctrine\Route;

use Doctrine\Common\Persistence\ObjectRepository;
use Offloc\Router\Domain\Model\Route\Route;
use Offloc\Router\Domain\Model\Route\RouteRepositoryInterface;
use Offloc\Router\Domain\Model\Service\Service;
use Offloc\Router\Domain\Model\SessionInterface;

/**
 * Doctrine implementation of the Route Repository
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class RouteRepository implements RouteRepositoryInterface
{
    /**
     * @var EntityRepository
     */
    private $routeRepository;

    /**
     * Constructor
     *
     * @param SessionInterface $session         Session
     * @param ObjectRepository $routeRepository Service repository
     */
    public function __construct(SessionInterface $session, ObjectRepository $routeRepository)
    {
        $this->session = $session;
        $this->routeRepository = $routeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return $this->routeRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findByService(Service $service)
    {
        return $this->routeRepository->findBy(array('service' => $service));
    }

    /**
     * {@inheritdoc}
     */
    public function store(Route $route)
    {
        $this->session->persist($route);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(Route $route)
    {
        $this->session->remove($route);
    }
}

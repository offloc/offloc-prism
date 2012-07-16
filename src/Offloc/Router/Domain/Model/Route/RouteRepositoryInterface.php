<?php

/*
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Model\Route;

use Offloc\Router\Domain\Model\Service\Service;

/**
 * Defines the Route repository
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface RouteRepositoryInterface
{
    /**
     * Find
     *
     * @param string $id ID
     *
     * @return Route
     */
    public function find($id);

    /**
     * Find all (by service)
     *
     * @param Service $service Service
     *
     * @return array
     */
    public function findByService(Service $service);

    /**
     * Store
     *
     * @param Route $route Route
     */
    public function store(Route $route);

    /**
     * Remove
     *
     * @param Route $route Route
     */
    public function remove(Route $route);
}

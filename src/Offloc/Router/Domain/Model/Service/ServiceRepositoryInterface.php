<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Model\Service;

/**
 * Defines the Service repository
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface ServiceRepositoryInterface
{
    /**
     * Find
     * 
     * @param string $key Key
     * 
     * @return Service
     */
    public function find($key);

    /**
     * Find all
     * 
     * @return array
     */
    public function findAll();

    /**
     * Find all (by name)
     * 
     * @param string $name Name
     * 
     * @return array
     */
    public function findByName($name);

    /**
     * Store
     * 
     * @param Service $service Service
     */
    public function store(Service $service);

    /**
     * Remove
     * 
     * @param Service $service Service
     */
    public function remove(Service $service);
}

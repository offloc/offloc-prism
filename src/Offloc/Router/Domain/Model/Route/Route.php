<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Model\Route;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Offloc\Router\Domain\Model\Service\Service;

/**
 * Defines the Route model
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Route
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * Target URL
     *
     * @var string
     */
    private $target;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayCollection
     */
    private $headers;

    /**
     * @var Service
     */
    private $service;

    /**
     * Constructor
     *
     * @param Service $service Service
     * @param mixed   $id      Route ID
     * @param string  $target  Target URL
     * @param string  $name    Name
     * @param array   $headers Headers
     */
    public function __construct(Service $service, $id, $target, $name = null, Collection $headers = null)
    {
        $this->service = $service;
        $this->id = $id;
        $this->target = $target;
        $this->name = $name;
        $this->headers = null !== $headers ? $headers : new ArrayCollection;
    }

    /**
     * @return Service
     */
    public function service()
    {
        return $this->service;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Target URL
     *
     * @return string
     */
    public function target()
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Route
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function headers()
    {
        return $this->headers;
    }
}

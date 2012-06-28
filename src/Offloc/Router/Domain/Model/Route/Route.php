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
     * @var Service
     */
    private $service;

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
     * @var Collection
     */
    private $headers;

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
     * Name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Set name
     *
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
     * Get headers
     *
     * @return array
     */
    public function headers()
    {
        $headers = array();

        foreach ($this->headers as $key => $header) {
            $headers[$key] = $header->value();
        }

        return $headers;
    }

    /**
     * Set header
     *
     * @param string $key   Header
     * @param string $value Value
     *
     * @return Route
     */
    public function setHeader($key, $value)
    {
        if ($this->headers->contains($key)) {
            $this->headers->get($key)->setValue($value);
        } else {
            $this->headers->set($key, new Header($this, $key, $value));
        }

        return $this;
    }

    /**
     * Get header
     *
     * @param string $key Header
     *
     * @return string
     */
    public function getHeader($key)
    {
        return $this->headers->get($key);
    }

    /**
     * Unset header
     *
     * @param string $key Header
     *
     * @return Route
     */
    public function unsetHeader($key)
    {
        $this->headers->remove($key);

        return $this;
    }
}

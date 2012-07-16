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

use Doctrine\Common\Collections\ArrayCollection;
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
    public function __construct(Service $service, $id, $target, $name = null, array $headers = array())
    {
        $this->service = $service;
        $this->id = $id;
        $this->target = $target;
        $this->name = $name;
        $this->headers = new ArrayCollection;

        if (null !== $headers) {
            foreach ($headers as $key => $value) {
                $this->setHeader($key, $value);
            }
        }
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
     * Has header?
     *
     * @param string $key Header
     *
     * @return bool
     */
    public function hasHeader($key)
    {
        return $this->headers->containsKey($key);
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
        if ($this->headers->containsKey($key)) {
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
        if (null !== $header = $this->headers->get($key)) {
            return $header->value();
        }

        return null;
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
        $header = $this->headers->get($key);
        $this->headers->removeElement($header);

        return $this;
    }
}

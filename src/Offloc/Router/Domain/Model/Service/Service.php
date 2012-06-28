<?php

/**
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Model\Service;

/**
 * Defines the Service model
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Service
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var bool
     */
    private $active;

    /**
     * Constructor
     *
     * @param string $key    Key
     * @param string $name   Name
     * @param string $url    URL
     * @param string $secret Secret
     * @param bool   $active Active?
     */
    public function __construct($key, $name, $url, $secret = '*', $active = true)
    {
        $this->key = $key;
        $this->name = $name;
        $this->url = $url;
        $this->secret = $secret;
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param string $name Name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function secret()
    {
        return $this->secret;
    }

    /**
     * Set secret
     *
     * @param string $secret
     *
     * @return Service
     */
    public function setSecret($secret = '*')
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Active?
     *
     * @return bool
     */
    public function active()
    {
        return $this->active;
    }

    /**
     * Activate
     *
     * @return Service
     */
    public function activate()
    {
        $this->active = true;

        return $this;
    }

    /**
     * Deactivate
     *
     * @return Service
     */
    public function deactivate()
    {
        $this->active = false;

        return $this;
    }
}

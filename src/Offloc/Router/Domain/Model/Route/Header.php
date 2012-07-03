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

/**
 * Defines the Header model
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Header
{
    /**
     * @var Route
     */
    private $route;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * Constructor
     *
     * @param Route  $route Route
     * @param string $key   Key
     * @param string $value Value
     */
    public function __construct(Route $route, $key, $value)
    {
        $this->route = $route;
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Value
     *
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param string $value Value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}

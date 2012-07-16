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
use Offloc\Router\Domain\Service\IdentityGeneratorServiceInterface;

/**
 * Defines the Service factory
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class RouteFactory
{
    /**
     * @var IdentityGeneratorServiceInterface
     */
    private $idGenerator;

    /**
     * Constructor
     *
     * @param IdentityGeneratorServiceInterface $idGenerator Identity generator service
     */
    public function __construct(IdentityGeneratorServiceInterface $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    /**
     * Create service
     *
     * @param Service $service Service
     * @param string  $target  Target
     * @param string  $name    Name
     * @param string  $id      Requested identity
     * @param array   $headers Headers
     *
     * @return Route
     */
    public function create(Service $service, $target, $name = null, $id = null, array $headers = array())
    {
        $id = $this->idGenerator->generateIdentity($id);

        return new Route($service, $id, $target, $name, $headers);
    }
}

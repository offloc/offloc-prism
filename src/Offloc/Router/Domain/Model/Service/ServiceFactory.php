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

use Offloc\Router\Domain\Service\KeyGeneratorServiceInterface;
use Offloc\Router\Domain\Service\SecretGeneratorServiceInterface;

/**
 * Defines the Service factory
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceFactory
{
    /**
     * Constructor
     * 
     * @param KeyGeneratorServiceInterface    $keyGenerator    Key generator service
     * @param SecretGeneratorServiceInterface $secretGenerator Secret generator service
     */
    public function __construct(KeyGeneratorServiceInterface $keyGenerator, SecretGeneratorServiceInterface $secretGenerator)
    {
        $this->keyGenerator = $keyGenerator;
        $this->secretGenerator = $secretGenerator;
    }

    /**
     * Create service
     * 
     * @param string $name   Name
     * @param string $url    URL
     * @param bool   $active Active?
     * 
     * @return Service
     */
    public function create($name, $url, $active = true)
    {
        $key = $this->keyGenerator->generateKey();
        $secret = $this->secretGenerator->generateSecret();
        
        return new Service($key, $name, $url, $secret, $active);
    }
}

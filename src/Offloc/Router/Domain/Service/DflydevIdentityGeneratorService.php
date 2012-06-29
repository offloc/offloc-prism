<?php

/**
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Service;

use Dflydev\IdentityGenerator\IdentityGenerator;

/**
 * Defines the Secret Generate service interface
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class DflydevIdentityGeneratorService implements IdentityGeneratorServiceInterface
{
    /**
     * Constructor
     *
     * @param IdentityGenerator $identityGenerator Identity Generator
     */
    public function __construct(IdentityGenerator $identityGenerator)
    {
        $this->identityGenerator = $identityGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function generateIdentity($suggestion = null)
    {
        return $this->identityGenerator->generate($suggestion);
    }
}
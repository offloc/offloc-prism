<?php

/**
 * This file is a part of offloc/prism.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Prism\Domain\Service;

/**
 * Defines the Identity Generator service interface
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface IdentityGeneratorServiceInterface
{
    /**
     * Generate key
     *
     * @param string $suggestion Requested identity
     *
     * @return string
     */
    public function generateIdentity($suggestion = null);
}

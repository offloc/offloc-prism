<?php

/**
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Service;

/**
 * Defines the Secret Generate service interface
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface SecretGeneratorServiceInterface
{
    /**
     * Generate secret
     *
     * @return string
     */
    public function generateSecret();
}

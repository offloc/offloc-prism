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

use Lootils\Uuid\Uuid;

/**
 * Defines the Secret Generate service interface
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class UuidSecretGeneratorService implements SecretGeneratorServiceInterface
{
    /**
     * Generate secret
     *
     * @return string
     */
    public function generateSecret()
    {
        return Uuid::createV4()->getUuid();
    }
}

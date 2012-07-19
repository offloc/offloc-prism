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
 * Defines the Simple Random String Identity Generator service
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class SimpleRandomStringIdentityGeneratorService implements IdentityGeneratorServiceInterface
{
    /**
     * @var int
     */
    protected $maxLength;

    /**
     * Constructor
     *
     * @param int $maxLength Max length of identity
     */
    public function __construct($maxLength = null)
    {
        $this->maxLength = $maxLength;
    }

    /**
     * {@inheritdoc}
     */
    public function generateIdentity($suggestion = null)
    {
        $bytes = false;
        if (function_exists('openssl_random_pseudo_bytes') && 0 !== stripos(PHP_OS, 'win')) {
            $bytes = openssl_random_pseudo_bytes(32, $strong);

            if (true !== $strong) {
                $bytes = false;
            }
        }

        // let's just hope we got a good seed
        if (false === $bytes) {
            $bytes = hash('sha256', uniqid(mt_rand(), true), true);
        }

        $wholeToken = base_convert(bin2hex($bytes), 16, 36);

        return null === $this->maxLength ? $wholeToken : substr($wholeToken, 0, $this->maxLength);
    }
}

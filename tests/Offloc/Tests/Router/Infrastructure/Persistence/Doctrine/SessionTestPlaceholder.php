<?php

/*
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Tests\Router\Infrastructure\Persistence\Doctrine;

/**
 * Defines the Session test placeholder
 *
 * Used by the Session test as a generic object.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class SessionTestPlaceholder
{
    /**
     * Constructor
     *
     * @param string $value Value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}

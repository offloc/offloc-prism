<?php

/**
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Api\Common;

/**
 * Defines the Message
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Message
{
    const TYPE_ERROR = 'error';

    const TYPE_ROOT = 'root';

    const TYPE_AUTH_ROOT = 'auth_root';

    const TYPE_ROUTE_ROOT = 'route_root';
    const TYPE_ROUTE_LINK = 'route_link';
    const TYPE_ROUTE_DETAIL = 'route_detail';

    const TYPE_SERVICE_ROOT = 'service_root';
    const TYPE_SERVICE_LINK = 'service_link';
    const TYPE_SERVICE_DETAIL = 'service_detail';
}

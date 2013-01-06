<?php

/**
 * This file is a part of offloc/prism.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Prism\Api\Common\Util;

/**
 * Defines the String utility
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class String
{
    /**
     * Convert hex to base
     *
     * @param string $str String
     *
     * @return string
     */
    public static function hexToBase64($str)
    {
        $raw = '';

        for ($i = 0; $i < strlen($str); $i += 2) {
            $raw .= chr(hexdec(substr($str, $i, 2)));
        }

        return base64_encode($raw);
    }

    /**
     * Normalize a query string.
     *
     * It builds a normalized query string, where keys/value pairs are
     * alphabetized and have consistent escaping.
     *
     * The following method is derived from the Symfony HttpFoundation
     * component (2012-07-02)
     *
     * Code subject to the MIT license.
     *
     * (c) Fabien Potencier <fabien@symfony.com>
     *
     * @param string $qs Query string
     *
     * @return string|null A normalized query string for the Request
     *
     * @api
     */
    public static function normalizeQueryString($qs = null)
    {
        if (!$qs) {
            return null;
        }

        $parts = array();
        $order = array();

        foreach (explode('&', $qs) as $segment) {
            if (false === strpos($segment, '=')) {
                $parts[] = $segment;
                $order[] = $segment;
            } else {
                $tmp = explode('=', rawurldecode($segment), 2);
                $parts[] = rawurlencode($tmp[0]).'='.rawurlencode($tmp[1]);
                $order[] = $tmp[0];
            }
        }
        array_multisort($order, SORT_ASC, $parts);

        return implode('&', $parts);
    }
}

<?php

/*
 * This file is a part of offloc/prism.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Prism\Api\Common\Tests\Util;

use Offloc\Prism\Api\Common\Util\String;

/**
 * Defines the String utility test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $input  Input
     * @param string $output Expected output
     *
     * @dataProvider hexToBase64DataProvider
     */
    public function testHexToBase64($input, $output)
    {
        $this->assertEquals($output, String::hexToBase64($input));
    }

    /**
     * @param string $input  Input
     * @param string $output Expected output
     *
     * @dataProvider normalizeQueryStringDataProvider
     */
    public function testNormalizeQueryString($input, $output)
    {
        $this->assertEquals($output, String::normalizeQueryString($input));
    }

    /**
     * Test normalizeQueryString with null and empty input
     */
    public function testNormalizeQueryStringNull()
    {
        $this->assertNull(String::normalizeQueryString(''));
        $this->assertNull(String::normalizeQueryString(null));
    }

    /**
     * Provide text data for normalizeQueryString test
     *
     * @return array
     */
    public function hexToBase64DataProvider()
    {
        return array(
            array('00', 'AA=='),
            array('01', 'AQ=='),
        );
    }

    /**
     * Provide text data for hexToBase64 test
     *
     * @return array
     */
    public function normalizeQueryStringDataProvider()
    {
        return array(
            array(
                'c&a&b',
                'a&b&c',
            ),
            array(
                'b=B&d&a=A&c=C&e=E',
                'a=A&b=B&c=C&d&e=E',
            ),
            array(
                'b[]=B&a[]=A&c[]=C',
                'a%5B%5D=A&b%5B%5D=B&c%5B%5D=C',
            ),
            array(
                'b%5B%5D=B&a%5B%5D=A&c[]=C',
                'a%5B%5D=A&b%5B%5D=B&c%5B%5D=C',
            ),
            array(
                'a[]=A2&b=B&a[]=A1&c=C&a[]=A0',
                'a%5B%5D=A0&a%5B%5D=A1&a%5B%5D=A2&b=B&c=C',
            ),
        );
    }
}

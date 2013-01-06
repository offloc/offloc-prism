<?php

/*
 * This file is a part of offloc/prism.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Prism\Domain\Model\Route;

use Offloc\Prism\Domain\Model\Service\Service;

/**
 * Defines the Service test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
    protected function getService()
    {
        return new Service('service key', 'Some Service', 'http://example.com');
    }

    /**
     * Test name
     */
    public function testName()
    {
        $route = new Route($this->getService(), 'some id', 'http://example.com/something');

        $this->assertNull($route->name());

        $route->setName(null);

        $this->assertNull($route->name());

        $route->setName();

        $this->assertNull($route->name());

        $route->setName('Some Name');

        $this->assertEquals('Some Name', $route->name());
    }

    /**
     * Test name from constructor
     */
    public function testNameFromConstructor()
    {
        $route = new Route($this->getService(), 'some id', 'http://example.com/something', 'Some Name');

        $this->assertEquals('Some Name', $route->name());
    }

    public function testHeaders()
    {
        $route = new Route($this->getService(), 'some id', 'http://example.com/something');

        $this->assertEquals(array(), $route->headers());

        $route->setHeader('hello', 'world');

        $headers = $route->headers();

        $this->assertEquals('world', $headers['hello']);

        $route->setHeader('foo', 'bar');

        $headers = $route->headers();

        $this->assertEquals('world', $headers['hello']);
        $this->assertEquals('bar', $headers['foo']);
    }

    /**
     * Test has header
     */
    public function testHasHeader()
    {
        $route = new Route($this->getService(), 'some id', 'http://example.com/something');

        $this->assertFalse($route->hasHeader('hello'));

        $route->setHeader('hello', 'world');

        $this->assertTrue($route->hasHeader('hello'));
    }

    /**
     * Test set header
     */
    public function testSetHeader()
    {
        $route = new Route($this->getService(), 'some id', 'http://example.com/something');

        $this->assertFalse($route->hasHeader('hello'));

        $route->setHeader('hello', 'world');

        $this->assertTrue($route->hasHeader('hello'));
        $this->assertEquals('world', $route->getHeader('hello'));

        $route->setHeader('hello', 'again');

        $this->assertEquals('again', $route->getHeader('hello'));
    }

    /**
     * Test getting header that does not exist
     */
    public function testGetHeaderDoesNotExist()
    {
        $route = new Route($this->getService(), 'some id', 'http://example.com/something');

        $this->assertNull($route->getHeader('does not exist'));
    }

    /**
     * Test unsetting header
     */
    public function testUnsetHeader()
    {
        $route = new Route($this->getService(), 'some id', 'http://example.com/something', null, array('hello' => 'world'));

        $this->assertEquals('world', $route->getHeader('hello'));
        $this->assertNull($route->getHeader('empty'));

        $route->unsetHeader('hello');
        $this->assertNull($route->getHeader('hello'));

        $route->unsetHeader('empty');
        $this->assertNull($route->getHeader('empty'));
    }
}

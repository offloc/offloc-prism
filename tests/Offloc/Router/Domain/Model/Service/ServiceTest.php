<?php

/*
 * This file is a part of offloc/router.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Model\Service;

/**
 * Defines the Service test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test name
     */
    public function testName()
    {
        $service = new Service('service key', 'Some Service', 'http://example.com');

        $this->assertEquals('Some Service', $service->name());

        $service->setName('Some Other Service');

        $this->assertEquals('Some Other Service', $service->name());
    }

    /**
     * Test secret
     */
    public function testSecret()
    {
        $service = new Service('service key', 'Some Service', 'http://example.com');

        $this->assertEquals('*', $service->secret());

        $service->setSecret('foo');

        $this->assertEquals('foo', $service->secret());

        $service->setSecret();

        $this->assertEquals('*', $service->secret());

        $service->setSecret(null);

        $this->assertNull($service->secret());
    }

    /**
     * Test secret from constructor
     */
    public function testSecretFromConstructor()
    {
        $service = new Service('service key', 'Some Service', 'http://example.com', 'foo');

        $this->assertEquals('foo', $service->secret());
    }

    /**
     * Test active
     */
    public function testActive()
    {
        $service = new Service('service key', 'Some Service', 'http://example.com');

        $this->assertTrue($service->active());

        $service->deactivate();

        $this->assertFalse($service->active());

        $service->activate();

        $this->assertTrue($service->active());
    }

    /**
     * Test setting active flag from constructor
     */
    public function testActiveFromConstructor()
    {
        $service = new Service('service key', 'Some Service', 'http://example.com', null, false);

        $this->assertFalse($service->active());
    }

    /**
     * Test canAdmin method
     */
    public function testCanAdmin()
    {
        $service = new Service('service key', 'Some Service', 'http://example.com');

        $dummyService = new Service('service key test', 'Some Service Test', 'http://test.example.com');

        $this->assertFalse($service->admin());

        $this->assertFalse($service->canAdmin($dummyService));

        $service->enableAdmin();

        $this->assertTrue($service->admin());

        $this->assertTrue($service->canAdmin($dummyService));

        $service->disableAdmin();

        $this->assertFalse($service->canAdmin($dummyService));
    }

    /**
     * Test setting admin flag from constructor
     */
    public function testAdminFromConstructor()
    {
        $service = new Service('service key', 'Some Service', 'http://example.com', null, null, true);

        $this->assertTrue($service->admin());
    }
}

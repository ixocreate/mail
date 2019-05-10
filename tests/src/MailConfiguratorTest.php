<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail;

use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Mail\MailConfig;
use Ixocreate\Mail\MailConfigurator;
use Ixocreate\Mail\Option\TransportOptionInterface;
use PHPUnit\Framework\TestCase;

class MailConfiguratorTest extends TestCase
{
    /**
     * @var MailConfigurator
     */
    private $mailConfigurator;

    public function setUp()
    {
        $this->mailConfigurator = new MailConfigurator();
    }

    public function testRegisterService()
    {
        $collector = [];

        $serviceRegistry = $this->createMock(ServiceRegistryInterface::class);
        $serviceRegistry->method('add')->willReturnCallback(function ($name, $object) use (&$collector) {
            $collector[$name] = $object;
        });

        $this->mailConfigurator->registerService($serviceRegistry);

        $this->assertArrayHasKey(MailConfig::class, $collector);
        $this->assertInstanceOf(MailConfig::class, $collector[MailConfig::class]);
    }

    /**
     * @covers \Ixocreate\Mail\MailConfigurator::setTransport
     * @covers \Ixocreate\Mail\MailConfigurator::getTransport
     */
    public function testTransport()
    {
        /** @var TransportOptionInterface $transport */
        $transport = $this->createMock(TransportOptionInterface::class);
        $this->mailConfigurator->setTransport($transport);
        $this->assertSame($transport, $this->mailConfigurator->getTransport());
    }
}

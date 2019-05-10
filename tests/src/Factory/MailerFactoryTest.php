<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail\Factory;

use Ixocreate\Mail\Factory\MailerFactory;
use Ixocreate\Mail\MailConfig;
use Ixocreate\Mail\MailConfigurator;
use Ixocreate\Mail\Mailer;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class MailerFactoryTest extends TestCase
{
    private $mailConfigurator;

    public function setUp()
    {
        $this->mailConfigurator = new MailConfigurator();
    }

    /**
     * @throws \Exception
     */
    public function testFactoryProducesMailer()
    {
        $container = [MailConfig::class => new MailConfig($this->mailConfigurator)];

        $serviceManager = $this->createMock(ServiceManagerInterface::class);
        $serviceManager->method('get')->willReturnCallback(function ($id) use (&$container){
            return $container[$id];
        });

        $factory = new MailerFactory();

        /** @var Mailer $mailer */
        $mailer = $factory($serviceManager, MailerFactory::class);

        $this->assertInstanceOf(Mailer::class, $mailer);
    }
}

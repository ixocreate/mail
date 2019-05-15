<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail\Factory;

use Ixocreate\Application\Service\ServiceManagerConfig;
use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Mail\Factory\MailerFactory;
use Ixocreate\Mail\MailConfig;
use Ixocreate\Mail\MailConfigurator;
use Ixocreate\Mail\Mailer;
use Ixocreate\ServiceManager\ServiceManager;
use Ixocreate\ServiceManager\ServiceManagerSetup;
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
        $serviceManagerConfigurator = new ServiceManagerConfigurator();

        $serviceManagerConfigurator->addService(MailConfigurator::class);
        $serviceManagerConfigurator->addFactory(MailConfig::class);

        $serviceManagerConfig = new ServiceManagerConfig($serviceManagerConfigurator);

        $serviceManagerSetup = new ServiceManagerSetup();

        $serviceManager = new ServiceManager($serviceManagerConfig, $serviceManagerSetup);

        $mailerFactory = new MailerFactory();

        $mailer = $mailerFactory($serviceManager, Mailer::class);

        $this->assertInstanceOf(Mailer::class, $mailer);
    }
}

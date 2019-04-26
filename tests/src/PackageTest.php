<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail;

use Ixocreate\Application\Configurator\ConfiguratorRegistryInterface;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Mail\MailBootstrapItem;
use Ixocreate\Mail\Package;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\Mail\Package
     */
    public function testPackage()
    {
        $configuratorRegistry = $this->getMockBuilder(ConfiguratorRegistryInterface::class)->getMock();
        $serviceRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $serviceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();

        $package = new Package();
        $package->configure($configuratorRegistry);
        $package->addServices($serviceRegistry);
        $package->boot($serviceManager);

        $this->assertSame([MailBootstrapItem::class], $package->getBootstrapItems());
        $this->assertNull($package->getConfigDirectory());
        $this->assertNull($package->getConfigProvider());
        $this->assertNull($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}

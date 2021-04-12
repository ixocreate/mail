<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail;

use Ixocreate\Mail\MailBootstrapItem;
use Ixocreate\Mail\Package;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\Mail\Package
     */
    public function testPackage()
    {
        $package = new Package();

        $this->assertSame([MailBootstrapItem::class], $package->getBootstrapItems());

        $this->assertEmpty($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}

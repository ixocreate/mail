<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail;

use Ixocreate\Mail\MailConfig;
use Ixocreate\Mail\MailConfigurator;
use Ixocreate\Mail\Option\TransportOptionInterface;
use PHPUnit\Framework\TestCase;

class MailConfigTest extends TestCase
{
    /**
     * @var MailConfig
     */
    private $mailConfig;

    /**
     * @var MailConfigurator
     */
    private $mailConfigurator;

    public function setUp(): void
    {
        $this->mailConfigurator = new MailConfigurator();
        $this->mailConfig = new MailConfig($this->mailConfigurator);
    }

    public function testTransport()
    {
        $this->assertInstanceOf(TransportOptionInterface::class, $this->mailConfig->transport());
    }

    public function testSerialize()
    {
        $serialize = \serialize($this->mailConfigurator->getTransport());
        $this->assertSame($serialize, $this->mailConfig->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize($this->mailConfigurator->getTransport());
        $unserialize = \unserialize($serialize);

        $configSerialize = $this->mailConfig->serialize();
        $this->mailConfig->unserialize($configSerialize);

        $this->assertEquals($unserialize, $this->mailConfig->transport());
    }
}

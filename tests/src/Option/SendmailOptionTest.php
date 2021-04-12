<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail\Option;

use Ixocreate\Mail\Option\SendmailOption;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class SendmailOptionTest extends TestCase
{
    /**
     * @var string
     */
    private $command;

    /**
     * @var SendmailOption
     */
    private $sendMailOption;

    public function setUp(): void
    {
        $this->command = 'foo';
        $this->sendMailOption = new SendmailOption($this->command);
    }

    public function test__construct()
    {
        $sendMailOption = new SendmailOption();
        $this->assertInstanceOf(SendmailOption::class, $sendMailOption);
    }

    public function testCreate()
    {
        $serviceManager = $this->createMock(ServiceManagerInterface::class);
        $transport = $this->sendMailOption->create($serviceManager);
        $this->assertInstanceOf(\Swift_SendmailTransport::class, $transport);
    }

    public function testSerialize()
    {
        $serialize = \serialize($this->command);
        $this->assertSame($serialize, $this->sendMailOption->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize($this->command);

        $this->sendMailOption->unserialize($serialize);

        $this->assertSame($this->command, $this->sendMailOption->command());
    }

    public function testCommand()
    {
        $this->assertSame($this->command, $this->sendMailOption->command());
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail;

use Ixocreate\Mail\Mailer;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    /**
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    public function setUp()
    {
        /** @var \Swift_Transport $transport */
        $transport = $this->createMock(\Swift_Transport::class);

        $this->swiftMailer = new \Swift_Mailer($transport);
    }

    public function test__construct()
    {
        $mailer = new Mailer($this->swiftMailer);
        $this->assertInstanceOf(Mailer::class, $mailer);
    }

    public function testSend()
    {
        $mailer = new Mailer($this->swiftMailer);

        /** @var \Swift_Mime_SimpleMessage $message */
        $message = $this->createMock(\Swift_Mime_SimpleMessage::class);

        $this->assertEquals($this->swiftMailer->send($message), $mailer->send($message));
    }
}

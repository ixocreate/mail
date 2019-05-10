<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail\Transport;

use Ixocreate\Mail\Transport\DirectoryTransport;
use PHPUnit\Framework\TestCase;

class DirectoryTransportTest extends TestCase
{
    /**
     * @var DirectoryTransport
     */
    private $directoryTransport;

    public function setUp()
    {
        $this->directoryTransport = new DirectoryTransport('foo');
    }

    public function test__construct()
    {
        $this->assertInstanceOf(DirectoryTransport::class, $this->directoryTransport);
    }

    public function testStop()
    {
        $this->doesNotPerformAssertions();
    }

    public function testStart()
    {
        $this->doesNotPerformAssertions();
    }

    public function testSend()
    {
        $message = $this->createMock(\Swift_Mime_SimpleMessage::class);
        $message->method('toString')->willReturn('foo');
        $message->method('getTo')->willReturn([]);
        $message->method('getCc')->willReturn([]);
        $message->method('getBcc')->willReturn([]);

        $this->assertIsInt($this->directoryTransport->send($message));

        $content = \scandir(__DIR__);
        foreach ($content as $file) {
            if (\pathinfo($file, PATHINFO_EXTENSION) === 'eml') {
                \unlink($file);
            }
        }
    }

    public function testPing()
    {
        $this->assertEquals(true, $this->directoryTransport->ping());
    }

    public function testIsStarted()
    {
        $this->assertEquals(true, $this->directoryTransport->isStarted());
    }

    public function testRegisterPlugin()
    {
        $this->doesNotPerformAssertions();
    }
}

<?php

namespace Ixocreate\Test\Mail\Option;

use Ixocreate\Mail\Option\SmtpOption;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class SmtpOptionTest extends TestCase
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var SmtpOption
     */
    private $smtpOption;

    public function setUp()
    {
        $this->host = 'foo.bar.com';
        $this->port = 25;
        $this->username = 'foo';
        $this->password = 'bar';
        $this->smtpOption = new SmtpOption($this->host, $this->port, $this->username, $this->password);
    }

    public function test__construct()
    {
        $this->assertInstanceOf(SmtpOption::class, $this->smtpOption);
    }

    public function test__constructThrowsInvalidArgumentException()
    {
        $encryption = 'foo';
        $this->expectException(\InvalidArgumentException::class);

        new SmtpOption($this->host, $this->port, $this->username, $this->password, $encryption);
    }

    public function test__constructExceptionMessage()
    {
        $encryption = 'foo';
        $this->expectExceptionMessage('encryption must be ssl or tls');
        new SmtpOption($this->host, $this->port, $this->username, $this->password, $encryption);
    }

    public function testIfTlsEncryptionIsSet()
    {
        $encryption = 'tls';
        $smtpOption = new SmtpOption($this->host, $this->port, $this->username, $this->password, $encryption);
        $this->assertInstanceOf(SmtpOption::class, $smtpOption);
        $this->assertSame($encryption, $smtpOption->encryption());
    }

    public function testIfSslEncryptionIsSet()
    {
        $encryption = 'ssl';
        $smtpOption = new SmtpOption($this->host, $this->port, $this->username, $this->password, $encryption);
        $this->assertInstanceOf(SmtpOption::class, $smtpOption);
        $this->assertSame($encryption, $smtpOption->encryption());
    }

    public function testCreateWithoutUsernameAndPassword()
    {
        $serviceManager = $this->createMock(ServiceManagerInterface::class);
        $smtpOption = new SmtpOption($this->host, $this->port);
        $transport = $smtpOption->create($serviceManager);
        $this->assertInstanceOf(\Swift_SmtpTransport::class, $transport);
    }

    public function testCreateWithUsernameAndPassword()
    {
        $serviceManager = $this->createMock(ServiceManagerInterface::class);
        $smtpOption = new SmtpOption($this->host, $this->port, $this->username, $this->password);
        $transport = $smtpOption->create($serviceManager);
        $this->assertInstanceOf(\Swift_SmtpTransport::class, $transport);
        $this->assertSame($this->username, $transport->getUsername());
        $this->assertSame($this->password, $transport->getPassword());
    }

    public function testHost()
    {
        $this->assertSame($this->host, $this->smtpOption->host());
    }

    public function testPort()
    {
        $this->assertSame($this->port, $this->smtpOption->port());
    }

    public function testUsername()
    {
        $this->assertSame($this->username,$this->smtpOption->username());
    }

    public function testPassword()
    {
        $this->assertSame($this->password, $this->smtpOption->password());
    }

    public function testEncryption()
    {
        $encryptions = ['tls', 'ssl'];
        foreach ($encryptions as $encryption) {
            $smtpOption = new SmtpOption($this->host, $this->port, $this->username, $this->password, $encryption);
            $this->assertSame($encryption, $smtpOption->encryption());
        }
    }

    public function testSerialize()
    {
        $settings = [
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'password' => $this->password,
            'encryption' => 'tls'
        ];
        $serialize = \serialize($settings);

        $smtpOption = new SmtpOption($this->host, $this->port, $this->username, $this->password, 'tls');

        $this->assertSame($serialize, $smtpOption->serialize());
    }

    public function testUnserialize()
    {
        $settings = [
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'password' => $this->password,
            'encryption' => 'tls'
        ];
        $serialize = \serialize($settings);
        $unserialize = \unserialize($serialize);

        $smtpOption = new SmtpOption($this->host, $this->port, $this->username, $this->password, 'tls');
        $smtpOption->unserialize($serialize);

        $smtpSettings = [
            'host' => $smtpOption->host(),
            'port' => $smtpOption->port(),
            'username' => $smtpOption->username(),
            'password' => $smtpOption->password(),
            'encryption' => $smtpOption->encryption()
        ];
        $this->assertSame($unserialize, $smtpSettings);
    }
}

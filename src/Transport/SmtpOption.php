<?php

declare(strict_types=1);

namespace Ixocreate\Package\Mail\Transport;

use Ixocreate\ServiceManager\ServiceManagerInterface;

final class SmtpOption implements TransportOptionInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port = 25;

    /**
     * @var ?string
     */
    private $username;

    /**
     * @var ?string
     */
    private $password;

    /**
     * @var ?string
     */
    private $encryption;

    /**
     * SmtpOption constructor.
     * @param string $host
     * @param int $port
     * @param $username
     * @param $password
     * @param $encryption
     */
    public function __construct(string $host, int $port, ?string $username = null, ?string $password = null, $encryption = null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;

        if ($encryption !== null) {

            if ($this->encryption != 'tls' && $this->encryption != 'ssl') {
                throw new \InvalidArgumentException('encryption must be ssl or tls');
            }
            stream_get_transports();

            $this->encryption = $encryption;
        }
    }

    public function create(ServiceManagerInterface $serviceManager): \Swift_Transport
    {
        $transport = (new \Swift_SmtpTransport($this->host, $this->port, $this->encryption));
        if (!empty($this->username)) {
            $transport->setUsername($this->username);
        }
        if (!empty($this->password)) {
            $transport->setPassword($this->password);
        }

        return $transport;
    }

    /**
     * @return string
     */
    public function host(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function port(): int
    {
        return $this->port;
    }

    /**
     * @return string|null
     */
    public function username(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function password(): ?string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function encryption(): ?string
    {
        return $this->encryption;
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail\Option;

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
            if ($encryption != 'tls' && $encryption != 'ssl') {
                throw new \InvalidArgumentException('encryption must be ssl or tls');
            }
            \stream_get_transports();

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

    /**
     * @return string
     */
    public function serialize()
    {
        return \serialize([
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'password' => $this->password,
            'encryption' => $this->encryption,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $unserialize = \unserialize($serialized);

        $this->host = $unserialize['host'];
        $this->port = $unserialize['port'];
        $this->username = $unserialize['username'];
        $this->password = $unserialize['password'];
        $this->encryption = $unserialize['encryption'];
    }
}

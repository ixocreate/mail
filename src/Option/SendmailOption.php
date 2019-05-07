<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail\Option;

use Ixocreate\ServiceManager\ServiceManagerInterface;

final class SendmailOption implements TransportOptionInterface
{
    /**
     * @var string
     */
    private $command;

    /**
     * SendmailOption constructor.
     * @param string $command
     */
    public function __construct(?string $command = null)
    {
        $this->command = $command ?? '/usr/sbin/sendmail -bs';
    }

    public function create(ServiceManagerInterface $serviceManager): \Swift_Transport
    {
        $transport = (new \Swift_SendmailTransport($this->command));

        return $transport;
    }

    /**
     * @return string
     */
    public function command(): string
    {
        return $this->command;
    }

    public function serialize()
    {
        return \serialize($this->command);
    }

    public function unserialize($serialized)
    {
        $this->command = \unserialize($serialized);
    }
}

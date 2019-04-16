<?php

declare(strict_types=1);

namespace Ixocreate\Package\Mail;

use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Contract\Application\ServiceRegistryInterface;
use Ixocreate\Package\Mail\Transport\TransportOptionInterface;

class MailConfigurator implements ConfiguratorInterface
{
    /**
     * @var TransportOptionInterface
     */
    private $transportOption;

    public function setTransport(TransportOptionInterface $transportOption)
    {
        $this->transportOption = $transportOption;
    }

    public function getTransport(): ?TransportOptionInterface
    {
        return $this->transportOption;
    }

    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
    }
}

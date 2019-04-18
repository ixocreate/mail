<?php

declare(strict_types=1);

namespace Ixocreate\Mail\Package;

use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Application\ServiceRegistryInterface;
use Ixocreate\Mail\Package\Transport\TransportOptionInterface;

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

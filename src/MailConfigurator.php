<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail\Package;

use Ixocreate\Application\Service\Configurator\ConfiguratorInterface;
use Ixocreate\Application\Service\Registry\ServiceRegistryInterface;
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

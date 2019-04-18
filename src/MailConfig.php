<?php

declare(strict_types=1);

namespace Ixocreate\Mail\Package;

use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Application\ServiceRegistryInterface;
use Ixocreate\Mail\Package\Transport\TransportOptionInterface;

class MailConfig implements \Serializable
{
    /**
     * @var TransportOptionInterface
     */
    private $transportOption;

    /**
     * MailConfig constructor.
     * @param MailConfigurator $configurator
     */
    public function __construct(MailConfigurator $configurator)
    {
        $this->transportOption = $configurator->getTransport();
    }

    public function transport(): TransportOptionInterface
    {
        return $this->transportOption;
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

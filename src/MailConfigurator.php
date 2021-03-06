<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail;

use Ixocreate\Application\Configurator\ConfiguratorInterface;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Mail\Option\SendmailOption;
use Ixocreate\Mail\Option\TransportOptionInterface;

final class MailConfigurator implements ConfiguratorInterface
{
    /**
     * @var TransportOptionInterface
     */
    private $transportOption;

    /**
     * MailConfigurator constructor.
     */
    public function __construct()
    {
        $this->transportOption = new SendmailOption();
    }

    public function setTransport(TransportOptionInterface $transportOption)
    {
        $this->transportOption = $transportOption;
    }

    public function getTransport(): TransportOptionInterface
    {
        return $this->transportOption;
    }

    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $serviceRegistry->add(MailConfig::class, new MailConfig($this));
    }
}

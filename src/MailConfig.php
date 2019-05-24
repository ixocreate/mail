<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail;

use Ixocreate\Application\Service\SerializableServiceInterface;
use Ixocreate\Mail\Option\TransportOptionInterface;

final class MailConfig implements SerializableServiceInterface
{
    /**
     * @var TransportOptionInterface
     */
    private $transportOption;

    /**
     * MailConfig constructor.
     *
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
        return \serialize($this->transportOption);
    }

    public function unserialize($serialized)
    {
        $this->transportOption = \unserialize($serialized);
    }
}

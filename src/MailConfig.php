<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail;

use Ixocreate\Application\Service\SerializableServiceInterface;
use Ixocreate\Mail\Transport\TransportOptionInterface;

class MailConfig implements SerializableServiceInterface
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
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }
}

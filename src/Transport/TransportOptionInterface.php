<?php

declare(strict_types=1);

namespace Ixocreate\Package\Mail\Transport;

use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;

interface TransportOptionInterface extends \Serializable
{
    /**
     * @param ServiceManagerInterface $serviceManager
     * @return \Swift_Transport
     */
    public function create(ServiceManagerInterface $serviceManager): \Swift_Transport;
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail\Option;

use Ixocreate\ServiceManager\ServiceManagerInterface;

interface TransportOptionInterface extends \Serializable
{
    /**
     * @param ServiceManagerInterface $serviceManager
     * @return \Swift_Transport
     */
    public function create(ServiceManagerInterface $serviceManager): \Swift_Transport;
}

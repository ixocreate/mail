<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail\Option;

use Ixocreate\Mail\Transport\DirectoryTransport;
use Ixocreate\ServiceManager\ServiceManagerInterface;

final class DirectoryOption implements TransportOptionInterface
{
    /**
     * @var string
     */
    private $directory;

    /**
     * DirectoryOption constructor.
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        $this->directory = rtrim($directory, '/') . '/';
    }

    public function create(ServiceManagerInterface $serviceManager): \Swift_Transport
    {
        $transport = (new DirectoryTransport($this->directory));

        return $transport;
    }

    public function serialize()
    {
        return \serialize($this->directory);
    }

    public function unserialize($serialized)
    {
        $this->directory = \unserialize($serialized);
    }
}

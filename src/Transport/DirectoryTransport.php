<?php

declare(strict_types=1);

namespace Ixocreate\Mail\Transport;

use Swift_Events_EventListener;
use Swift_Mime_SimpleMessage;

class DirectoryTransport implements \Swift_Transport
{
    /**
     * @var string
     */
    private $directory;

    /**
     * DirectoryTransport constructor.
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function isStarted()
    {
        return true;
    }

    public function start()
    {
    }

    public function stop()
    {
    }

    public function ping()
    {
        return true;
    }

    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $content = $message->toString();

        \file_put_contents($this->directory .  \time() . '_' . \mt_rand() . '.eml', $content);

        $count = (
            count((array) $message->getTo())
            + count((array) $message->getCc())
            + count((array) $message->getBcc())
        );
        return $count;
    }

    public function registerPlugin(Swift_Events_EventListener $plugin)
    {

    }
}

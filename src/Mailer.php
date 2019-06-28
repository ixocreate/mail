<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail;

final class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * Mailer constructor.
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(\Swift_Mime_SimpleMessage $message)
    {
        return $this->mailer->send($message);
    }
}

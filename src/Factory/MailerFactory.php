<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail\Factory;

use Ixocreate\Mail\MailConfig;
use Ixocreate\Mail\Mailer;
use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;

final class MailerFactory implements FactoryInterface
{
    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @throws \Exception
     * @return mixed
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {

        /** @var MailConfig $config */
        $config = $container->get(MailConfig::class);

        $transport = $config->transport()->create($container);
        $mailer = new \Swift_Mailer($transport);

        return new Mailer($mailer);
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Mail;

use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Mail\Factory\MailerFactory;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addService(Mailer::class, MailerFactory::class);

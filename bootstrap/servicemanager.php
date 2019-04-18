<?php
declare(strict_types=1);

namespace Ixocreate\Mail;

use Ixocreate\Mail\Factory\MailerFactory;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addService(Mailer::class, MailerFactory::class);

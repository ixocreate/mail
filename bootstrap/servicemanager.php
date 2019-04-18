<?php
declare(strict_types=1);

namespace Ixocreate\Package\Mail;

use Ixocreate\Package\Mail\Factory\MailerFactory;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addService(Mailer::class, MailerFactory::class);

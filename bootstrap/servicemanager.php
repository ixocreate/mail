<?php
declare(strict_types=1);

namespace Ixocreate\Mail\Package;

use Ixocreate\Mail\Package\Factory\MailerFactory;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addService(Mailer::class, MailerFactory::class);

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Mail\BootstrapItem;

use Ixocreate\Contract\Application\BootstrapItemInterface;
use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Package\Mail\MailConfigurator;

final class MailBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new MailConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return 'mail';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'mail.php';
    }
}

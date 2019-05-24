<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail;

use Ixocreate\Mail\MailBootstrapItem;
use Ixocreate\Mail\MailConfigurator;
use PHPUnit\Framework\TestCase;

class MailBootstrapItemTest extends TestCase
{
    /**
     * @covers \Ixocreate\Mail\MailBootstrapItem
     */
    public function testBootstrapItem()
    {
        $item = new MailBootstrapItem();

        $this->assertSame('mail.php', $item->getFileName());
        $this->assertSame('mail', $item->getVariableName());
        $this->assertInstanceOf(MailConfigurator::class, $item->getConfigurator());
    }
}

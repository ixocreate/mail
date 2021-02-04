<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Mail\Option;

use Ixocreate\Mail\Option\DirectoryOption;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class DirectoryOptionTest extends TestCase
{
    /**
     * @var DirectoryOption
     */
    private $directoryOption;

    /**
     * @var string
     */
    private $directory;

    public function setUp(): void
    {
        $this->directory = 'foo/';
        $this->directoryOption = new DirectoryOption($this->directory);
    }

    public function test__construct()
    {
        $this->assertInstanceOf(DirectoryOption::class, $this->directoryOption);
    }

    public function testCreate()
    {
        /** @var ServiceManagerInterface $serviceManager */
        $serviceManager = $this->createMock(ServiceManagerInterface::class);

        $transport = $this->directoryOption->create($serviceManager);
        $this->assertInstanceOf(\Swift_Transport::class, $transport);
    }

    public function testSerialize()
    {
        $serialize = \serialize($this->directory);
        $this->assertSame($serialize, $this->directoryOption->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize($this->directory);

        $this->directoryOption->unserialize($serialize);

        $reflection = new \ReflectionClass($this->directoryOption);
        $property = $reflection->getProperty('directory');
        $property->setAccessible(true);

        $this->assertSame($this->directory, $property->getValue($this->directoryOption));
    }
}

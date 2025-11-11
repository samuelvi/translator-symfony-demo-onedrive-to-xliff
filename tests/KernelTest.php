<?php

declare(strict_types=1);

namespace App\Tests;

use App\Kernel;
use PHPUnit\Framework\TestCase;

final class KernelTest extends TestCase
{
    public function testKernelInstantiation(): void
    {
        $kernel = new Kernel('test', true);

        $this->assertInstanceOf(Kernel::class, $kernel);
        $this->assertSame('test', $kernel->getEnvironment());
        $this->assertTrue($kernel->isDebug());
    }

    public function testKernelWithProductionEnvironment(): void
    {
        $kernel = new Kernel('prod', false);

        $this->assertSame('prod', $kernel->getEnvironment());
        $this->assertFalse($kernel->isDebug());
    }
}

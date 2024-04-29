<?php

declare(strict_types=1);

namespace App\Tests\Api\Integration;

use App\Api\Integration\AllegroIntegration;
use App\Api\Integration\IntegrationStrategy;
use App\Api\Integration\IntegrationStrategyInterface;
use PHPUnit\Framework\TestCase;

class IntegrationStrategyTest extends TestCase
{
    public function testResolveIntegrationReturnsExpectedIntegration(): void
    {
        $expectedIntegration = $this->createMock(AllegroIntegration::class);
        $expectedIntegration->expects($this->once())
            ->method('supports')
            ->with('allegro')
            ->willReturn(true);

        $integrationStrategy = new IntegrationStrategy([$expectedIntegration]);

        $resolvedIntegration = $integrationStrategy->resolveIntegration('allegro');

        $this->assertSame($expectedIntegration, $resolvedIntegration);
    }

    public function testResolveIntegrationWithNonExistentIntegration_ReturnsNull(): void
    {
        $allegroIntegrationMock = $this->createMock(AllegroIntegration::class);
        $allegroIntegrationMock->expects($this->once())
            ->method('supports')
            ->with('amazon')
            ->willReturn(false);

        $integrationStrategy = new IntegrationStrategy([$allegroIntegrationMock]);

        $result = $integrationStrategy->resolveIntegration('amazon');

        $this->assertNull($result);
    }

    public function testImplementsIntegrationStrategyInterface(): void
    {
        $this->assertInstanceOf(
            IntegrationStrategyInterface::class,
            new IntegrationStrategy([])
        );
    }
}

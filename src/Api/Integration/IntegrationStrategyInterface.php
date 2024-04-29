<?php

declare(strict_types=1);

namespace App\Api\Integration;

interface IntegrationStrategyInterface
{
    public function resolveIntegration(string $integrationName): ?MarketplaceIntegrationInterface;
}

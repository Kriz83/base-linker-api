<?php

declare(strict_types=1);

namespace App\Api\Integration;

abstract class AbstractMarketplaceIntegration implements MarketplaceIntegrationInterface
{
    private const INTEGRATION_NAME = 'default';

    public function getIntegrationName(): string
    {
        return self::INTEGRATION_NAME;
    }

    public function supports(string $integrationName): bool
    {
        return $integrationName === $this->getIntegrationName();
    }
}

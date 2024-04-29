<?php

declare(strict_types=1);

namespace App\Api\Integration;

abstract class AbstractMarketplaceIntegration implements MarketplaceIntegrationInterface
{
    protected const INTEGRATION_NAME = 'default';

    abstract public function getIntegrationName(): string;

    public function supports(string $integrationName): bool
    {
        return $integrationName === $this->getIntegrationName();
    }
}

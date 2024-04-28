<?php

declare(strict_types=1);

namespace App\Api\Integration;

abstract class AbstractMarketplaceIntegration implements MarketplaceIntegrationInterface
{
    protected const INTEGRATION_NAME = 'default';

    public function getIntegrationName(): string
    {
        return static::INTEGRATION_NAME;
    }
}

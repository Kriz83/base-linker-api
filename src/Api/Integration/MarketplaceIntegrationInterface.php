<?php

declare(strict_types=1);

namespace App\Api\Integration;

interface MarketplaceIntegrationInterface
{
    public function getIntegrationName(): string;

    public function supports(string $integrationName): bool;
}

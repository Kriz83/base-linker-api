<?php

declare(strict_types=1);

namespace App\Api\Integration;

class AllegroIntegration extends AbstractMarketplaceIntegration
{
    protected const INTEGRATION_NAME = 'allegro';

    public function getIntegrationName(): string
    {
        return self::INTEGRATION_NAME;
    }
}

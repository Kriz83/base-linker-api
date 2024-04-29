<?php

declare(strict_types=1);

namespace App\Api\Integration;

class AmazonIntegration extends AbstractMarketplaceIntegration
{
    protected const INTEGRATION_NAME = 'amazon';

    public function getIntegrationName(): string
    {
        return self::INTEGRATION_NAME;
    }
}

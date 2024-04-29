<?php

declare(strict_types=1);

namespace App\Api\Integration;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class IntegrationStrategy implements IntegrationStrategyInterface
{
    public function __construct(
        #[TaggedIterator('integration')] private iterable $integrations,
    ) {
    }

    public function resolveIntegration(string $integrationName): ?MarketplaceIntegrationInterface
    {
        /** @var MarketplaceIntegrationInterface $integration */
        foreach ($this->integrations as $integration) {
            if ($integration->supports($integrationName)) {
                return $integration;
            }
        }

        return null;
    }
}

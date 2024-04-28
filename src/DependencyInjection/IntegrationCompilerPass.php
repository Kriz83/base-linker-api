<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use App\Api\Integration\IntegrationStrategy;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class IntegrationCompilerPass implements CompilerPassInterface
{
    public const SERVICE_ID = IntegrationStrategy::class;
    public const TAG_NAME = 'integration';

    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(self::SERVICE_ID)) {
            return;
        }

        $definition = $container->getDefinition(self::SERVICE_ID);
        $taggedServices = $container->findTaggedServiceIds(self::TAG_NAME);

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(IntegrationStrategy::METHOD_ADD_INTEGRATION, [new Reference($id)]);
        }
    }
}

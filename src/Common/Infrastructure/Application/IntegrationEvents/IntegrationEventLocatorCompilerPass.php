<?php
declare(strict_types=1);

namespace App\Common\Infrastructure\Application\IntegrationEvents;

use App\Common\Infrastructure\Messenger\Middleware\IntegrationEventsLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class IntegrationEventLocatorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $definition = $container->getDefinition(IntegrationEventsLocator::class);

        foreach ($container->findTaggedServiceIds('events.integration') as $id => $attributes) {
            $definition->addMethodCall(
                'add',
                [$id]
            );
        }
    }
}

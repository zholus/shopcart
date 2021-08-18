<?php
declare(strict_types=1);

namespace App\Cart\Application\IntegrationEvents;

use App\Cart\Application\RemoveItemFromAllCarts\RemoveItemFromAllCartsCommand;
use App\Catalog\Application\IntegrationEvents\ProductDeletedIntegrationEvent;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Event\EventHandler;

final class ProductDeletedIntegrationEventHandler implements EventHandler
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(ProductDeletedIntegrationEvent $event): void
    {
        $this->commandBus->dispatch(new RemoveItemFromAllCartsCommand($event->getProductId()));
    }
}

<?php
declare(strict_types=1);

namespace App\Cart\Application\IntegrationEvents;

use App\Cart\Application\ChangeItemsPrice\ChangeItemsPriceCommand;
use App\Catalog\Application\IntegrationEvents\ProductPriceChangedIntegrationEvent;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Event\EventHandler;

final class ProductPriceChangedIntegrationEventHandler implements EventHandler
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(ProductPriceChangedIntegrationEvent $event): void
    {
        $this->commandBus->dispatch(new ChangeItemsPriceCommand(
            $event->getProductId(),
            $event->getNewPrice()
        ));
    }
}

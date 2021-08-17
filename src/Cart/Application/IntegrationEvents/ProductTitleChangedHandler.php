<?php
declare(strict_types=1);

namespace App\Cart\Application\IntegrationEvents;

use App\Cart\Application\ChangeItemsTitle\ChangeItemsTitleCommand;
use App\Catalog\Application\IntegrationEvents\ProductTitleChangedIntegrationEvent;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Event\EventHandler;

final class ProductTitleChangedHandler implements EventHandler
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(ProductTitleChangedIntegrationEvent $event): void
    {
        $this->commandBus->dispatch(new ChangeItemsTitleCommand(
            $event->getProductId(),
            $event->getNewTitle()
        ));
    }
}

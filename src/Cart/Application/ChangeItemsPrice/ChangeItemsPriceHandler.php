<?php
declare(strict_types=1);

namespace App\Cart\Application\ChangeItemsPrice;

use App\Cart\Domain\ItemRepository;
use App\Common\Application\Command\CommandHandler;

final class ChangeItemsPriceHandler implements CommandHandler
{
    public function __construct(private ItemRepository $itemRepository)
    {
    }

    public function __invoke(ChangeItemsPriceCommand $command): void
    {
        $this->itemRepository->changeItemPrices($command->getExternalId(), $command->getNewPrice());
    }
}

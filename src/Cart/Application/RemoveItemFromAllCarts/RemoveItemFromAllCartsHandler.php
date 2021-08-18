<?php
declare(strict_types=1);

namespace App\Cart\Application\RemoveItemFromAllCarts;

use App\Cart\Domain\ItemRepository;
use App\Common\Application\Command\CommandHandler;

final class RemoveItemFromAllCartsHandler implements CommandHandler
{
    public function __construct(private ItemRepository $itemRepository)
    {
    }

    public function __invoke(RemoveItemFromAllCartsCommand $command): void
    {
        $this->itemRepository->removeItem($command->getExternalId());
    }
}

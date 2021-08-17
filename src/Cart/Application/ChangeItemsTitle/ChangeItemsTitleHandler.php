<?php
declare(strict_types=1);

namespace App\Cart\Application\ChangeItemsTitle;

use App\Cart\Domain\ItemRepository;
use App\Common\Application\Command\CommandHandler;

final class ChangeItemsTitleHandler implements CommandHandler
{
    public function __construct(private ItemRepository $itemRepository)
    {
    }

    public function __invoke(ChangeItemsTitleCommand $command): void
    {
        $this->itemRepository->changeItemTitles($command->getExternalId(), $command->getNewTitle());
    }
}

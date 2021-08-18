<?php
declare(strict_types=1);

namespace App\Cart\Application\ChangeItemsPrice;

use App\Common\Application\Command\Command;

final class ChangeItemsPriceCommand implements Command
{
    public function __construct(
        private int $externalId,
        private int $newPrice
    ) {
    }

    public function getExternalId(): int
    {
        return $this->externalId;
    }

    public function getNewPrice(): int
    {
        return $this->newPrice;
    }
}

<?php
declare(strict_types=1);

namespace App\Cart\Application\RemoveItemFromAllCarts;

use App\Common\Application\Command\Command;

final class RemoveItemFromAllCartsCommand implements Command
{
    public function __construct(
        private int $externalId
    ) {
    }

    public function getExternalId(): int
    {
        return $this->externalId;
    }
}

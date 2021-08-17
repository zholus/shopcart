<?php
declare(strict_types=1);

namespace App\Cart\Application\RemoveItemFromCart;

use App\Common\Application\Command\Command;

final class RemoveItemFromCartCommand implements Command
{
    public function __construct(
        private string $cartId,
        private int $externalId
    ) {
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getExternalId(): int
    {
        return $this->externalId;
    }
}

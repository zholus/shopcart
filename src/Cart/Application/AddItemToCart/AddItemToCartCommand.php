<?php
declare(strict_types=1);

namespace App\Cart\Application\AddItemToCart;

use App\Common\Application\Command\Command;

final class AddItemToCartCommand implements Command
{
    public function __construct(
        private string $cartId,
        private string $itemId,
        private int $externalId,
        private string $title,
        private int $price
    ) {
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function getExternalId(): int
    {
        return $this->externalId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}

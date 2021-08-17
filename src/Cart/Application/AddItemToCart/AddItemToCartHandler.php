<?php
declare(strict_types=1);

namespace App\Cart\Application\AddItemToCart;

use App\Cart\Domain\CartId;
use App\Cart\Domain\CartRepository;
use App\Cart\Domain\ItemId;
use App\Common\Application\Command\CommandHandler;

final class AddItemToCartHandler implements CommandHandler
{
    public function __construct(private CartRepository $cartRepository)
    {
    }

    public function __invoke(AddItemToCartCommand $command): void
    {
        $cartId = new CartId($command->getCartId());

        $cart = $this->cartRepository->findById($cartId);

        $cart->addItem(
            new ItemId($command->getItemId()),
            $command->getExternalId(),
            $command->getTitle(),
            $command->getPrice()
        );

        $this->cartRepository->update($cart);
    }
}

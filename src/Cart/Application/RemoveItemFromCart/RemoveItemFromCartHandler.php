<?php
declare(strict_types=1);

namespace App\Cart\Application\RemoveItemFromCart;

use App\Cart\Domain\CartId;
use App\Cart\Domain\CartRepository;
use App\Common\Application\Command\CommandHandler;

final class RemoveItemFromCartHandler implements CommandHandler
{
    public function __construct(private CartRepository $cartRepository)
    {
    }

    public function __invoke(RemoveItemFromCartCommand $command): void
    {
        $cart = $this->cartRepository->findById(new CartId($command->getCartId()));

        $cart->remoteItemByExternalId($command->getExternalId());

        $this->cartRepository->update($cart);
    }
}

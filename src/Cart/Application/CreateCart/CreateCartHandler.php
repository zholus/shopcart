<?php
declare(strict_types=1);

namespace App\Cart\Application\CreateCart;

use App\Cart\Domain\Cart;
use App\Cart\Domain\CartId;
use App\Cart\Domain\CartRepository;
use App\Common\Application\Command\CommandHandler;

final class CreateCartHandler implements CommandHandler
{
    public function __construct(private CartRepository $cartRepository)
    {
    }

    public function __invoke(CreateCartCommand $command): void
    {
        $cart = Cart::create(new CartId($command->getId()));

        $this->cartRepository->save($cart);
    }
}

<?php
declare(strict_types=1);

namespace App\Tests\Cart\Integration\RemoveItemFromCart;

use App\Cart\Application\GetCartDetailsById\GetCartDetailsByIdQuery;
use App\Cart\Application\ReadModel\Cart;
use App\Cart\Application\RemoveItemFromCart\RemoveItemFromCartCommand;
use App\Tests\Cart\Integration\TestCase;

final class RemoveItemFromCartTest extends TestCase
{
    public function testRemoveItemFromCart(): void
    {
        $this->loadCarts();

        $cartId = $this->getCartId();

        $this->commandBus->dispatch(new RemoveItemFromCartCommand($cartId, 1));

        /** @var Cart $cartReadModel */
        $cartReadModel = $this->queryBus->handle(new GetCartDetailsByIdQuery($cartId));

        $this->assertCount(2,$cartReadModel->getItems());
    }
}

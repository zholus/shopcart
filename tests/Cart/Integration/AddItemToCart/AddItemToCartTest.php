<?php
declare(strict_types=1);

namespace App\Tests\Cart\Integration\AddItemToCart;

use App\Cart\Application\AddItemToCart\AddItemToCartCommand;
use App\Cart\Application\CreateCart\CreateCartCommand;
use App\Cart\Application\GetCartDetailsById\GetCartDetailsByIdQuery;
use App\Cart\Application\ReadModel\Cart;
use App\Cart\Application\ReadModel\Item;
use App\Cart\Domain\CannotAddMoreItemsToCartException;
use App\Tests\Cart\Integration\TestCase;
use Ramsey\Uuid\Uuid;

final class AddItemToCartTest extends TestCase
{
    public function testAddItemToCard()
    {
        $cartId = Uuid::uuid4()->toString();
        $itemId = Uuid::uuid4()->toString();
        $externalId = 1;
        $title = 'witcher';
        $price = 123321;

        $this->commandBus->dispatch(new CreateCartCommand($cartId));

        $this->commandBus->dispatch(new AddItemToCartCommand(
            $cartId,
            $itemId,
            $externalId,
            $title,
            $price
        ));

        /** @var Cart $cartReadModel */
        $cartReadModel = $this->queryBus->handle(new GetCartDetailsByIdQuery($cartId));

        $this->assertEquals(
            new Item($itemId, $externalId, $title, $price),
            $cartReadModel->getItems()[0]
        );
    }

    public function testCannotAddMoreThanThreeItemsToCard()
    {
        $cartId = Uuid::uuid4()->toString();
        $externalId = 1;
        $title = 'witcher';
        $price = 123321;

        $this->commandBus->dispatch(new CreateCartCommand($cartId));

        $this->commandBus->dispatch(new AddItemToCartCommand(
            $cartId,
            Uuid::uuid4()->toString(),
            $externalId,
            $title,
            $price
        ));

        $this->commandBus->dispatch(new AddItemToCartCommand(
            $cartId,
            Uuid::uuid4()->toString(),
            $externalId,
            $title,
            $price
        ));

        $this->commandBus->dispatch(new AddItemToCartCommand(
            $cartId,
            Uuid::uuid4()->toString(),
            $externalId,
            $title,
            $price
        ));

        $this->expectException(CannotAddMoreItemsToCartException::class);

        $this->commandBus->dispatch(new AddItemToCartCommand(
            $cartId,
            Uuid::uuid4()->toString(),
            $externalId,
            $title,
            $price
        ));
    }
}

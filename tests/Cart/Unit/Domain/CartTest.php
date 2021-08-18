<?php
declare(strict_types=1);

namespace App\Tests\Cart\Unit\Domain;

use App\Cart\Domain\CannotAddMoreItemsToCartException;
use App\Cart\Domain\ItemId;
use App\Tests\Cart\Unit\CartBuilder;
use App\Tests\UnitTestCase;
use Ramsey\Uuid\Uuid;

final class CartTest extends UnitTestCase
{
    public function testAddNotMoreThatThreeItemsToCart(): void
    {
        $this->expectException(CannotAddMoreItemsToCartException::class);

        $cart = CartBuilder::create()
            ->build();

        $cart->addItem(
            new ItemId(Uuid::uuid4()->toString()),
            3,
            'witcher',
            3
        );

        $cart->addItem(
            new ItemId(Uuid::uuid4()->toString()),
            3,
            'witcher',
            3
        );

        $cart->addItem(
            new ItemId(Uuid::uuid4()->toString()),
            3,
            'witcher',
            3
        );

        $cart->addItem(
            new ItemId(Uuid::uuid4()->toString()),
            3,
            'witcher',
            3
        );
    }

    public function testRemoveItemsFromCart(): void
    {
        $cart = CartBuilder::create()
            ->build();

        $cart->addItem(
            new ItemId(Uuid::uuid4()->toString()),
            3,
            'witcher',
            3
        );

        $cart->addItem(
            new ItemId(Uuid::uuid4()->toString()),
            2,
            'witcher 2',
            4
        );

        $cart->remoteItemByExternalId(2);

        $snapshot = $cart->getSnapshot();

        $this->assertCount(1, $snapshot->getItems());
        $this->assertSame(3, $snapshot->getItems()[0]->getExternalId());
    }
}

<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure\Domain;

use App\Cart\Domain\Cart;
use App\Cart\Domain\CartId;
use App\Cart\Domain\CartRepository;
use App\Cart\Domain\Item;
use App\Cart\Domain\ItemId;
use Doctrine\DBAL\Connection;

final class DbalCartRepository implements CartRepository
{
    private const CARTS_TABLE = 'carts';
    private const CARTS_ITEMS_TABLE = 'carts_items';

    public function __construct(private Connection $connection)
    {
    }

    public function save(Cart $cart): void
    {
        $snapshot = $cart->getSnapshot();

        $this->connection->insert(self::CARTS_TABLE, [
            'id' => $snapshot->getId()
        ]);
    }

    public function findById(CartId $cartId): Cart
    {
        $qb = $this->connection->createQueryBuilder();

        $qb->select('id')
            ->from('carts')
            ->where('id = :ID')
            ->setParameter(':ID', $cartId->getId())
        ;

        $result = $qb->execute();

        $rowCart = $result->fetchAssociative();

        if ($rowCart === false) {
            // todo: throw
        }

        $qb = $this->connection->createQueryBuilder();

        $qb->select('id', 'external_id', 'title', 'price')
            ->from(self::CARTS_ITEMS_TABLE)
            ->where('cart_id = :ID')
            ->setParameter(':ID', $cartId->getId())
        ;

        $result = $qb->execute();

        $items = [];

        foreach ($result->fetchAllAssociative() as $rowItem) {
            $items[] = new Item(
                new ItemId($rowItem['id']),
                (int)$rowItem['external_id'],
                $rowItem['title'],
                (int)$rowItem['price']
            );
        }

        return new Cart(
            new CartId($rowCart['id']),
            $items
        );
    }

    public function update(Cart $cart): void
    {
        $cartSnapshot = $cart->getSnapshot();

        $this->connection->delete(self::CARTS_ITEMS_TABLE, [
            'cart_id' => $cartSnapshot->getId()
        ]);

        foreach ($cartSnapshot->getItems() as $item) {
            $this->connection->insert(self::CARTS_ITEMS_TABLE, [
                'id' => $item->getId(),
                'cart_id' => $cartSnapshot->getId(),
                'external_id' => $item->getExternalId(),
                'title' => $item->getTitle(),
                'price' => $item->getPrice()
            ]);
        }
    }
}

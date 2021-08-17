<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure\Application\ReadModel;

use App\Cart\Application\ReadModel\Cart;
use App\Cart\Application\ReadModel\CartNotFoundException;
use App\Cart\Application\ReadModel\CartReadModel;
use App\Cart\Application\ReadModel\Item;
use Doctrine\DBAL\Connection;

final class DbalCartReadModel implements CartReadModel
{
    private const CARTS_TABLE = 'carts';
    private const CARTS_ITEMS_TABLE = 'carts_items';

    public function __construct(private Connection $connection)
    {
    }

    public function findById(string $id): Cart
    {
        $qb = $this->connection->createQueryBuilder();

        $qb->select('id')
            ->from(self::CARTS_TABLE)
            ->where('id = :ID')
            ->setParameter(':ID', $id)
        ;

        $result = $qb->execute();

        if ($result->fetchAssociative() === false) {
            throw new CartNotFoundException(sprintf('Cart with id [%s] not found', $id));
        }

        $qb = $this->connection->createQueryBuilder();

        $qb->select('id', 'external_id', 'title', 'price')
            ->from(self::CARTS_ITEMS_TABLE)
            ->where('cart_id = :CART_ID')
            ->setParameter(':CART_ID', $id)
        ;

        $result = $qb->execute();

        $items = [];
        foreach ($result->fetchAllAssociative() as $row) {
            $items[] = new Item(
                $row['id'],
                (int)$row['external_id'],
                $row['title'],
                (int)$row['price']
            );
        }

        return new Cart(
            $id,
            $items
        );
    }
}

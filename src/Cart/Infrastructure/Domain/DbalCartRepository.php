<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure\Domain;

use App\Cart\Domain\Cart;
use App\Cart\Domain\CartRepository;
use Doctrine\DBAL\Connection;

final class DbalCartRepository implements CartRepository
{
    private const CART_TABLE = 'carts';

    public function __construct(private Connection $connection)
    {
    }

    public function save(Cart $cart): void
    {
        $snapshot = $cart->getSnapshot();

        $this->connection->insert(self::CART_TABLE, [
            'id' => $snapshot->getId()
        ]);
    }
}

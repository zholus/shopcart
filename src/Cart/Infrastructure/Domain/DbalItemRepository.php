<?php
declare(strict_types=1);

namespace App\Cart\Infrastructure\Domain;

use App\Cart\Domain\ItemRepository;
use Doctrine\DBAL\Connection;

final class DbalItemRepository implements ItemRepository
{
    private const CARTS_ITEMS_TABLE = 'carts_items';

    public function __construct(private Connection $connection)
    {
    }

    public function changeItemTitles(int $externalId, string $newTitle): void
    {
        $this->connection->update(
            self::CARTS_ITEMS_TABLE,
            ['title' => $newTitle],
            ['external_id' => $externalId]
        );
    }

    public function changeItemPrices(int $externalId, int $newPrices): void
    {
        $this->connection->update(
            self::CARTS_ITEMS_TABLE,
            ['price' => $newPrices],
            ['external_id' => $externalId]
        );
    }

    public function removeItem(int $externalId): void
    {
        $this->connection->delete(
            self::CARTS_ITEMS_TABLE,
            ['external_id' => $externalId]
        );
    }
}

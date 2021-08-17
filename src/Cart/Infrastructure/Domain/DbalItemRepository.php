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
}

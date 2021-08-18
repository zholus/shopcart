<?php
declare(strict_types=1);

namespace App\Cart\Domain;

interface ItemRepository
{
    public function changeItemTitles(int $externalId, string $newTitle): void;
    public function changeItemPrices(int $externalId, int $newPrices): void;
}

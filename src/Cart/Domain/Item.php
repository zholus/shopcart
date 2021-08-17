<?php
declare(strict_types=1);

namespace App\Cart\Domain;

class Item
{
    public function __construct(
        ItemId $id,
        string $title,
        int $count,
        int $price
    ) {
    }
}

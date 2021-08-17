<?php
declare(strict_types=1);

namespace App\Cart\Domain;

class Item
{
    public function __construct(
        private ItemId $id,
        private int $externalId,
        private string $title,
        private int $price
    ) {
    }

    public function getSnapshot(): ItemSnapshot
    {
        return new ItemSnapshot(
            $this->id->getId(),
            $this->externalId,
            $this->title,
            $this->price
        );
    }

    public function isExternalItem(int $externalId): bool
    {
        return $this->externalId === $externalId;
    }
}

<?php
declare(strict_types=1);

namespace App\Cart\Application\ReadModel;

class Item
{
    public function __construct(
        private string $id,
        private int $externalId,
        private string $title,
        private int $price,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getExternalId(): int
    {
        return $this->externalId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}

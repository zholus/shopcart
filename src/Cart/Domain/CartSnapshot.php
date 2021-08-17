<?php
declare(strict_types=1);

namespace App\Cart\Domain;

class CartSnapshot
{
    /**
     * @param ItemSnapshot[] $items
     */
    public function __construct(
        private string $id,
        private array $items
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}

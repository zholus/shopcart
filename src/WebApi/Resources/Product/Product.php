<?php
declare(strict_types=1);

namespace App\WebApi\Resources\Product;

class Product
{
    public function __construct(
        private int $id,
        private string $title,
        private int $price,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
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

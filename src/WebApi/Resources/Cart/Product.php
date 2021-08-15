<?php
declare(strict_types=1);

namespace App\WebApi\Resources\Cart;

class Product
{
    public function __construct(
        private int $id,
        private string $title,
        private int $singlePriceUnit,
        private int $count
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

    public function getSingleUnitPrice(): int
    {
        return $this->singlePriceUnit;
    }

    public function getTotalPrice(): int
    {
        return (int)bcmul((string)$this->singlePriceUnit, (string)$this->count);
    }

    public function getCount(): int
    {
        return $this->count;
    }
}

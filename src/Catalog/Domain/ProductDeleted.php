<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

use App\Common\Domain\DomainEvent;
use Money\Money;

final class ProductDeleted implements DomainEvent
{
    public function __construct(
        private ProductId $productId,
        private string $title,
        private Money $price
    ) {
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }
}

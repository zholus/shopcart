<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

use App\Common\Domain\DomainEvent;
use Money\Money;

final class PriceChanged implements DomainEvent
{
    public function __construct(
        private ProductId $productId,
        private Money $oldPrice,
        private Money $newPrice
    ) {
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function getOldPrice(): Money
    {
        return $this->oldPrice;
    }

    public function getNewPrice(): Money
    {
        return $this->newPrice;
    }
}

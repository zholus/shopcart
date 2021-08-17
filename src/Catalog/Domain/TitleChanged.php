<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

use App\Common\Domain\DomainEvent;

final class TitleChanged implements DomainEvent
{
    public function __construct(
        private ProductId $productId,
        private string $oldTitle,
        private string $newTitle
    ) {
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function getOldTitle(): string
    {
        return $this->oldTitle;
    }

    public function getNewTitle(): string
    {
        return $this->newTitle;
    }
}

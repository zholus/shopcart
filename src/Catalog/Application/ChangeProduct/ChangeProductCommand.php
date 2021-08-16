<?php
declare(strict_types=1);

namespace App\Catalog\Application\ChangeProduct;

use App\Common\Application\Command\Command;

final class ChangeProductCommand implements Command
{
    public function __construct(
        private int $productId,
        private ?string $title,
        private ?int $price,
    ) {
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }
}

<?php
declare(strict_types=1);

namespace App\Catalog\Application\CreateProduct;

use App\Common\Application\Command\Command;

final class CreateProductCommand implements Command
{
    public function __construct(
        private string $title,
        private int $price
    ) {
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

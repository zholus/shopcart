<?php
declare(strict_types=1);

namespace App\WebApi\Resources\Product;

class ProductPresenter
{
    public function __construct(private Product $product)
    {
    }

    public function present(): array
    {
        return [
            'id' => $this->product->getId(),
            'title' => $this->product->getTitle(),
            'price' => $this->product->getPrice(),
        ];
    }
}

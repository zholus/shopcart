<?php
declare(strict_types=1);

namespace App\WebApi\Resources\Cart;

class Cart
{
    public function __construct(
        private string $id,
        private ProductsList $productsList
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProductsList(): ProductsList
    {
        return $this->productsList;
    }

    public function getTotalPrice(): int
    {
        $sum = 0;

        foreach ($this->getProductsList()->getProducts() as $product) {
            $sum = (int)bcadd((string)$product->price(), (string)$sum);
        }

        return $sum;
    }
}

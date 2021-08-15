<?php
declare(strict_types=1);

namespace App\WebApi\Resources\Cart;

class Cart
{
    public function __construct(
        private int $id,
        private ProductsList $productsList
    ) {
    }

    public function getId(): int
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
            $sum = (int)bcadd((string)$product->getTotalPrice(), (string)$sum);
        }

        return $sum;
    }
}

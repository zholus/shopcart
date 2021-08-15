<?php
declare(strict_types=1);

namespace App\WebApi\Resources\Product;

class ProductsList
{
    private array $products;

    public function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}

<?php
declare(strict_types=1);

namespace App\Catalog\Domain;

interface ProductRepository
{
    public function add(Product $product): void;
    public function findById(ProductId $productId): Product;
}

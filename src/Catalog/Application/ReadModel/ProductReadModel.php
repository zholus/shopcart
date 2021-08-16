<?php
declare(strict_types=1);

namespace App\Catalog\Application\ReadModel;

interface ProductReadModel
{
    public function findByTitle(string $title): Product;
    public function findById(int $productId): Product;
}

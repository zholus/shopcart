<?php
declare(strict_types=1);

namespace App\Catalog\Application\ReadModel;

class ProductPaginated
{
    private PaginationData $paginationData;
    private array $products;

    public function __construct(
        PaginationData $paginationData,
        Product ...$products
    ) {
        $this->paginationData = $paginationData;
        $this->products = $products;
    }

    public function getPaginationData(): PaginationData
    {
        return $this->paginationData;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}

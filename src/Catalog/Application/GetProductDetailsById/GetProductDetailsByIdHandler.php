<?php
declare(strict_types=1);

namespace App\Catalog\Application\GetProductDetailsById;

use App\Catalog\Application\ReadModel\Product;
use App\Catalog\Application\ReadModel\ProductReadModel;
use App\Common\Application\Query\QueryHandler;

final class GetProductDetailsByIdHandler implements QueryHandler
{
    public function __construct(private ProductReadModel $productReadModel)
    {
    }

    public function __invoke(GetProductDetailsByIdQuery $query): Product
    {
        return $this->productReadModel->findById($query->getProductId());
    }
}

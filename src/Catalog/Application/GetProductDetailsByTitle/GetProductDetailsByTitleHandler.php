<?php
declare(strict_types=1);

namespace App\Catalog\Application\GetProductDetailsByTitle;

use App\Catalog\Application\ReadModel\Product;
use App\Catalog\Application\ReadModel\ProductReadModel;
use App\Common\Application\Query\QueryHandler;

final class GetProductDetailsByTitleHandler implements QueryHandler
{
    public function __construct(private ProductReadModel $productReadModel)
    {
    }

    public function __invoke(GetProductDetailsByTitleQuery $query): Product
    {
        return $this->productReadModel->findByTitle($query->getTitle());
    }
}

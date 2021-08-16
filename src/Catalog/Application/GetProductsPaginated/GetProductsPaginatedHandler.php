<?php
declare(strict_types=1);

namespace App\Catalog\Application\GetProductsPaginated;

use App\Catalog\Application\ReadModel\ProductPaginated;
use App\Catalog\Application\ReadModel\ProductReadModel;
use App\Common\Application\Query\QueryHandler;

final class GetProductsPaginatedHandler implements QueryHandler
{
    public function __construct(private ProductReadModel $productReadModel)
    {
    }

    public function __invoke(GetProductsPaginatedQuery $query): ProductPaginated
    {
        return $this->productReadModel->findAllPaginated($query->getPage());
    }
}

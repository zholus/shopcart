<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Integration\GetProductsPaginated;

use App\Catalog\Application\GetProductsPaginated\GetProductsPaginatedQuery;
use App\Catalog\Application\ReadModel\PaginationData;
use App\Catalog\Application\ReadModel\ProductPaginated;
use App\Tests\Catalog\Integration\TestCase;

final class GetProductsPaginatedTest extends TestCase
{
    public function testProductsPagination(): void
    {
        $this->loadProducts();

        /** @var ProductPaginated $list */
        $list = $this->queryBus->handle(new GetProductsPaginatedQuery(1));

        $this->assertEquals(
            new PaginationData(5, 3, 1, 2),
            $list->getPaginationData()
        );

        $this->assertCount(3,$list->getProducts());
    }
}

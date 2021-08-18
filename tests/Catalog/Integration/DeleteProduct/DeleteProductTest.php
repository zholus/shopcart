<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Integration\DeleteProduct;

use App\Catalog\Application\DeleteProduct\DeleteProductCommand;
use App\Catalog\Application\GetProductDetailsById\GetProductDetailsByIdQuery;
use App\Common\Application\NotFoundException;
use App\Tests\Catalog\Integration\TestCase;

final class DeleteProductTest extends TestCase
{
    public function testDeleteProduct(): void
    {
        $this->loadProducts();

        $this->commandBus->dispatch(new DeleteProductCommand(1));

        $this->expectException(NotFoundException::class);
        $this->queryBus->handle(new GetProductDetailsByIdQuery(1));
    }
}

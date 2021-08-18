<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Integration\ChangeProduct;

use App\Catalog\Application\ChangeProduct\ChangeProductCommand;
use App\Catalog\Application\GetProductDetailsById\GetProductDetailsByIdQuery;
use App\Tests\Catalog\Integration\TestCase;

final class ChangeProductTest extends TestCase
{
    public function testChangingTitle(): void
    {
        $this->loadProducts();

        $title = 'random title';
        $this->commandBus->dispatch(new ChangeProductCommand(1, $title, null));
        $product = $this->queryBus->handle(new GetProductDetailsByIdQuery(1));
        $this->assertSame(
            $title,
            $product->getTitle()
        );
    }

    public function testChangingPrice(): void
    {
        $this->loadProducts();

        $price = 1488228322;
        $this->commandBus->dispatch(new ChangeProductCommand(1, null, $price));
        $product = $this->queryBus->handle(new GetProductDetailsByIdQuery(1));
        $this->assertSame(
            $price,
            $product->getPrice()
        );
    }
}

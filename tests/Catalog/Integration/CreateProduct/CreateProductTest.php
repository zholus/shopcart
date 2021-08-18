<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Integration\CreateProduct;

use App\Catalog\Application\CreateProduct\CreateProductCommand;
use App\Catalog\Application\GetProductDetailsByTitle\GetProductDetailsByTitleQuery;
use App\Catalog\Application\ReadModel\Product;
use App\Catalog\Domain\ProductWithTitleExistsException;
use App\Tests\Catalog\Integration\TestCase;

final class CreateProductTest extends TestCase
{
    public function testCreateNewProduct(): void
    {
        $title = 'witcher';
        $price = 12300;

        $this->commandBus->dispatch(new CreateProductCommand(
            $title,
            $price
        ));

        /** @var Product $product */
        $product = $this->queryBus->handle(new GetProductDetailsByTitleQuery($title));

        $this->assertEquals(
            $price,
            $product->getPrice()
        );
        $this->assertEquals(
            $title,
            $product->getTitle()
        );
    }

    public function testCreateNewProductOnlyWithUniqName(): void
    {
        $this->expectException(ProductWithTitleExistsException::class);

        $this->commandBus->dispatch(new CreateProductCommand(
            'witcher',
            12300
        ));

        $this->commandBus->dispatch(new CreateProductCommand(
            'witcher',
            12300
        ));
    }
}

<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Unit\Domain;

use App\Catalog\Domain\PriceChanged;
use App\Catalog\Domain\Product;
use App\Catalog\Domain\ProductId;
use App\Catalog\Domain\ProductTitleUniquenessChecker;
use App\Catalog\Domain\ProductWithTitleExistsException;
use App\Catalog\Domain\TitleChanged;
use App\Common\Domain\DomainEvents;
use App\Tests\Catalog\Unit\ProductBuilder;
use App\Tests\UnitTestCase;
use Money\Money;
use PHPUnit\Framework\MockObject\MockObject;

final class ProductTest extends UnitTestCase
{
    private ProductTitleUniquenessChecker|MockObject $productTitleUniquenessChecker;

    public function setUp(): void
    {
        parent::setUp();

        $this->productTitleUniquenessChecker = $this->createMock(ProductTitleUniquenessChecker::class);
    }

    public function testCreateProductWithUniqueTitle(): void
    {
        $this->productTitleUniquenessChecker
            ->expects($this->once())
            ->method('isUnique')
            ->willReturn(false);

        $this->expectException(ProductWithTitleExistsException::class);

        Product::create(
            new ProductId(1),
            'title',
            Money::USD(54),
            $this->productTitleUniquenessChecker
        );
    }

    public function testProductCannotUseTakenTitle(): void
    {
        $this->productTitleUniquenessChecker
            ->expects($this->once())
            ->method('isUnique')
            ->willReturn(false);

        $this->expectException(ProductWithTitleExistsException::class);

        $product = ProductBuilder::create()
            ->build();

        $product->changeTitle('SHREK', $this->productTitleUniquenessChecker);
    }

    public function testProductPublishEventAfterChangeTitle(): void
    {
        $this->productTitleUniquenessChecker
            ->method('isUnique')
            ->willReturn(true);

        $product = ProductBuilder::create()
            ->withId(2)
            ->withTitle('superman')
            ->build();

        $product->changeTitle('SHREK', $this->productTitleUniquenessChecker);

        $this->assertEquals(
            new TitleChanged(new ProductId(2), 'superman', 'SHREK'),
            DomainEvents::getEvents()[0]
        );
    }

    public function testProductPublishEventAfterChangePrice(): void
    {
        $oldPrice = 123453;
        $newPrice = 11111;
        $product = ProductBuilder::create()
            ->withId(2)
            ->withPrice($oldPrice)
            ->build();

        $product->changePrice(Money::USD($newPrice));

        $this->assertEquals(
            new PriceChanged(new ProductId(2), Money::USD($oldPrice), Money::USD($newPrice)),
            DomainEvents::getEvents()[0]
        );
    }
}

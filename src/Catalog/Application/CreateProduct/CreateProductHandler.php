<?php
declare(strict_types=1);

namespace App\Catalog\Application\CreateProduct;

use App\Catalog\Domain\Product;
use App\Catalog\Domain\ProductId;
use App\Catalog\Domain\ProductRepository;
use App\Catalog\Domain\ProductTitleUniquenessChecker;
use App\Common\Application\Command\CommandHandler;
use Money\Money;

final class CreateProductHandler implements CommandHandler
{
    public function __construct(
        private ProductRepository $productRepository,
        private ProductTitleUniquenessChecker $titleUniquenessChecker
    ) {
    }

    public function __invoke(CreateProductCommand $command): void
    {
        $product = Product::create(
            ProductId::nullable(),
            $command->getTitle(),
            Money::USD($command->getPrice()),
            $this->titleUniquenessChecker
        );

        $this->productRepository->add($product);
    }
}

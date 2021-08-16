<?php
declare(strict_types=1);

namespace App\Catalog\Application\ChangeProduct;

use App\Catalog\Domain\ProductId;
use App\Catalog\Domain\ProductRepository;
use App\Catalog\Domain\ProductTitleUniquenessChecker;
use App\Common\Application\Command\CommandHandler;
use Money\Money;

final class ChangeProductHandler implements CommandHandler
{
    public function __construct(
        private ProductRepository $productRepository,
        private ProductTitleUniquenessChecker $titleUniquenessChecker
    ) {
    }

    public function __invoke(ChangeProductCommand $command): void
    {
        $productId = ProductId::fromInt($command->getProductId());

        $product = $this->productRepository->findById($productId);

        if ($command->getTitle() !== null) {
            $product->changeTitle($command->getTitle(), $this->titleUniquenessChecker);
        }

        if ($command->getPrice() !== null) {
            $product->changePrice(Money::USD($command->getPrice()));
        }
    }
}

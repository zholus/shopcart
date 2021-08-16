<?php
declare(strict_types=1);

namespace App\Catalog\Application\DeleteProduct;

use App\Catalog\Domain\ProductId;
use App\Catalog\Domain\ProductRepository;
use App\Common\Application\Command\CommandHandler;

final class DeleteProductHandler implements CommandHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(DeleteProductCommand $command): void
    {
        $product = $this->productRepository->findById(ProductId::fromInt($command->getProductId()));

        $this->productRepository->remove($product);
    }
}

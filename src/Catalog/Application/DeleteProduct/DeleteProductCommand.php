<?php
declare(strict_types=1);

namespace App\Catalog\Application\DeleteProduct;

use App\Common\Application\Command\Command;

final class DeleteProductCommand implements Command
{
    public function __construct(private int $productId)
    {
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}

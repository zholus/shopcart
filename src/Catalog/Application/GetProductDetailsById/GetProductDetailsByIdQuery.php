<?php
declare(strict_types=1);

namespace App\Catalog\Application\GetProductDetailsById;

use App\Common\Application\Query\Query;

final class GetProductDetailsByIdQuery implements Query
{
    public function __construct(private int $productId)
    {
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
